<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Demo_concorde\business\models\Article;
use Demo_concorde\business\models\Person;
use Demo_concorde\business\models\Author;
use Demo_concorde\business\models\Tag;
use Demo_concorde\business\models\Status;
use Demo_concorde\business\models\Comment;
use Demo_concorde\business\models\Folder;
use Demo_concorde\business\associations\Article_Tag;
use Concorde\artefact\Finder;
use Concorde\artefact\Query_manager;
use Concorde\utils\datetime\Mysql_date;
use Concorde\utils\datetime\Mysql_datetime;
use Concorde\utils\datetime\Now;

class Blog_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->output->enable_profiler(true);
    }

    public function test() {
        foreach (get_class_methods($this) as $method) {
            if (substr($method, 0, 8) === 'example_') {
                echo '<h1>Example ' . substr($method, 8) . '</h1>';
                echo '<br />';
                $this->{$method}();
                echo '<hr /><hr />';
            }
        }
    }

    public function example_1() {
        $article = Article::find(1);
        print_model($article);
    }

    public function example_2() {
        $articles = Article::all();
        print_models($articles);
    }

    public function example_3() {
        $tags = Tag::find([1, 2]);
        var_dump_models($tags);
    }

    public function example_4() {
        $person = Person::find(1);
        var_dump_model($person);
    }

    public function example_5() {
        // The Status model is an Enum_model.
        // An Enum_model is a class which matches with a table:
        //     - It must be simple: There is no foreign key
        //     - It must contain at least two fields: 'id' and 'name'
        //     - It is not supposed to change (except when there is an upgrade of the website)
        // An Enum_model is particularly suitable for data like a status or a type.

        $statuses = Status::all();
        var_dump_models($statuses);
        echo '<hr />';
        $statuses = Status::find_by_name(['ARCHIVED', 'ONLINE']);
        var_dump_models($statuses);
    }

    public function example_6() {
        $finder = new Finder('Article AS[alias_article]');
        $finder->with('author');
        $finder->where('alias_article:id', 1);
        $article = $finder->first();
        var_dump_model($article);
    }

    public function example_7() {
        $finder = new Finder('Article AS[alias_article]');
        $finder->with(array(
            'author',
            'comments',
        ));
        $finder->where('alias_article:id', 1);
        $article = $finder->first();
        var_dump_model($article);
    }

    public function example_8() {
        $finder = new Finder('Article AS[alias_article]');
        $finder->with(array(
            'author',
            'comments' => 'person',
        ));
        $finder->where('alias_article:id', 1);
        $article = $finder->first();
        var_dump_model($article);
    }

    public function example_9() {
        $finder = new Finder('Article AS[alias_article]');
        $finder->with(array(
            'author' => array('.<Person:comments'),
            'tags AS[model:alias_tag, association:alias_article_tag]',
        ));
        $finder->where('alias_article:id', 1)
               ->like('alias_tag:content', 'tag_', 'after')
               ->where('alias_article_tag:created_at >=', Mysql_datetime::create_from_format('Y-m-d|', '2019-01-01'));
        $article = $finder->first();
        var_dump_model($article);
    }

    public function example_10() {
        $qm = new Query_manager();
        $qm->select('id AS article:id, created_at AS article:created_at')
           ->from('article')
           ->where('id', 1);

        $qr = $qm->get();
        foreach ($qr->result() as $row) {
            $qm->convert_row($row);
            var_dump($row->{'article:id'});
            echo '<br />';
            var_dump($row->{'article:created_at'});
            echo '<br />';
        }
    }

    public function example_11() {
        $author = Author::find(1);
        $author->set('password', 'test1234');
        $author->set('is_admin', false);
        $author->save();
        var_dump_model($author);
    }

    public function example_12() {
        $finder = new Finder('Article AS[alias_article]');
        $finder->with('title');
        $finder->where('alias_article:id', 1);
        $article = $finder->first();
        var_dump($article->get_title()->get_content());

        echo '<br />';

        $article->get_title()->set('content', 'The new content of: article 1 - title');
        $article->get_title()->save();
        var_dump($article->get_title()->get_content());

        echo '<br />';

        $article->set('status', Status::find_by_name('ONLINE'))
                ->save();
        var_dump_model($article);
    }

    public function example_13() {
        $finder = new Finder('Article AS[alias_article]');
        $finder->with(array(
            'tags',
        ));
        $finder->where('alias_article:id', 1);
        $article = $finder->first();
        $articles_tags = $article->get_tags();
        list($article_tag) = $articles_tags;
        $article_tag->set('created_at', new Mysql_datetime('2019-03-06 09:06:25.740818'));
        $article_tag->save();
        var_dump_model($article);
    }

    public function example_14() {
        $author_id = Author::insert(
            array(
                'username'    => 'Paul',
                'password'    => 'Paul1234',
                'created_at'  => new Mysql_datetime('2019-03-05 11:05:45.740818'),
                'is_admin'    => false,
            ),
            true // because we want the method to return the insert id (false is the default value)
        );
        var_dump_model(Author::find($author_id));

        echo '<hr />';

        Author::update(
            $author_id,
            array(
                'password'  => 'Paul5678',
                'is_admin'  => true,
            )
        );
        var_dump_model(Author::find($author_id));

        echo '<hr />';

        Person::delete($author_id);
        var_dump_models(Person::all());
    }

    public function example_15() {
        $tag_id = Tag::insert(
            array(
                'content'  => 'tag_3',
            ),
            true
        );

        Article_Tag::insert(array(
            'article_id'  => 1,
            'tag_id'      => $tag_id,
            'created_at'  => new Mysql_datetime('2019-03-07 17:52:06.740818'),
        ));

        $finder = new Finder('Article AS[alias_article]');
        $finder->with(array(
            'tags',
        ));
        $finder->where('alias_article:id', 1);
        $article = $finder->first();
        var_dump_model($article);

        Article_Tag::delete(array(
            'article_id'  => 1,
            'tag_id'      => $tag_id,
        ));
        $article = $finder->first();
        var_dump_model($article);

        Tag::delete($tag_id);
        var_dump_models(Tag::all());
    }

    public function example_16() {
        $finder = new Finder('Article');
        $finder->with(array(
            'paragraphs AS[alias_paragraphs]',
            'author',
            'comments AS[alias_comment]' => array(
                'person',
            ),
        ));
        $finder->like('alias_paragraphs:content', 'paragraph');
        $finder->where('alias_comment:created_at >=', Mysql_datetime::create_from_format('Y-m-d|', '2019-01-03'));
        $finder->where('alias_comment:created_at <', Mysql_datetime::create_from_format('Y-m-d|', '2020-06-28'));
        $articles = $finder->get();
        var_dump_models($articles);
    }

    public function example_17() {
        $qm = new Query_manager();
        $qm->table('comment')
           ->set('content', 'The content of the comment')
           ->set('article_id', 1)
           ->set('person_id', 1)
           ->set('created_at', Mysql_datetime::create_from_format('Y-m-d|', '2019-04-03'));
        $comment_id = $qm->insert(true);

        var_dump_model(Comment::find($comment_id));
    }

    public function example_18() {
        $qm = new Query_manager();
        $qm->table('comment')
           ->where('created_at', Mysql_datetime::create_from_format('Y-m-d|', '2019-04-03'))
           ->delete();

        var_dump_models(Comment::all());
    }

    public function example_19() {
        $qm = new Query_manager();
        $qm->table('comment')
           ->where('created_at', Mysql_datetime::create_from_format('Y-m-d|', '2019-04-03'))
           ->set('content', 'The new content of the comment')
           ->update();

        var_dump_models(Comment::all());
    }

    public function example_20() {
        $qm = new Query_manager();
        $qm->select('alias_article.id AS alias_article:id, article_tag.created_at AS article_tag:created_at')
           ->from('article AS alias_article')
           ->join('article_tag', 'article_tag.article_id = alias_article.id')
           ->join('tag AS alias_tag', 'alias_tag.id = article_tag.tag_id')
           ->where('alias_tag.content', 'tag_2');
        $query = $qm->get();

        foreach ($query->result() as $row) {
            var_dump($row->{'alias_article:id'});
            echo '<br />';
            var_dump($row->{'article_tag:created_at'});
            echo '<br />';

            $qm->convert_row($row);

            var_dump($row->{'alias_article:id'});
            echo '<br />';
            var_dump($row->{'article_tag:created_at'});
            echo '<br />';
        }
    }

    public function example_21() {
        $article = Article::find(1);
        var_dump($article->get_created_at()->format('d/m/Y H:i'));
    }

    public function example_22() {
        $article_1 = Article::find(1);
        $article_2 = Article::find(2);
        echo '<pre>';
        var_dump($article_1->get_created_at()->diff($article_2->get_created_at()));
        echo '</pre>';
    }

    public function example_23() {
        $finder = new Finder('Folder AS[alias_folder]');
        $finder->with('subfolders|2');
        $finder->where('alias_folder:id', 1);
        $folder = $finder->first();
        var_dump_model($folder);
    }

    public function example_24() {
        $folder_table_depth_of_folder_1 = Folder::get_table_depth('parent_folder', 1);
        // equivalent to: $folder_table_depth_of_folder_1 = $this->db->get_table_depth('folder', 'parent_id', 1);

        $finder = new Finder('Folder AS[alias_folder]');
        $finder->with(array(
            'subfolders|' . ($folder_table_depth_of_folder_1 - 1) => array(
                'articles' => array(
                    'title',
                    'paragraphs',
                ),
            ),
        ));
        $finder->where('alias_folder:id', 1);
        $folder = $finder->first();
        var_dump_model($folder);
    }

    public function example_25() {
        // The difference between this example and the previous one is that in this example, we retrieve the articles of ALL the folders
        // whereas in the previous example, we retrieve the articles of all the folders EXCEPT those of the top level.

        $folder_table_depth_of_folder_1 = Folder::get_table_depth('parent_folder', 1);

        $finder = new Finder('Folder AS[alias_folder] REC[subfolders|' . ($folder_table_depth_of_folder_1 - 1) . ']');
        $finder->with(array(
            'articles' => array(
                'title',
                'paragraphs',
            ),
        ));
        $finder->where('alias_folder:id', 1);
        $folder = $finder->first();
        var_dump_model($folder);
    }

    public function example_26() {
        $folder_table_depth = Folder::get_table_depth('parent_folder');
        // equivalent to: $folder_table_depth = $this->db->get_table_depth('folder', 'parent_id');

        $finder = new Finder('Folder AS[alias_folder] REC[subfolders|' . ($folder_table_depth - 1) . ']');
        $finder->where('alias_folder:parent_id', null);
        $folders = $finder->get();
        var_dump_models($folders);
    }

    public function example_27() {
        $finder = new Finder('Author AS[alias_author]');
        $finder->with(array(
            '.<Person:orders AS[models:[Discount:alias_discount, Folder:alias_folder], association:alias_discount_folder_person] REC[Folder:subfolders|2]' => 'Folder:articles',
        ));
        $finder->where('alias_author:id', 1)
               ->where('alias_discount:start_date >=', Mysql_date::create_from_format('Y-m-d', '2019-01-01'))
               ->like('alias_folder:name', 'folder')
               ->where('alias_discount_folder_person:created_at >=', Mysql_datetime::create_from_format('Y-m-d|', '2019-01-01'));
        $author = $finder->first();
        var_dump_model($author);
    }

    public function example_28() {
        $article = Article::find(1);

        $finder = new Finder('Author AS[alias_author]');
        $finder->where('alias_author:id', 1);
        $author = $finder->first($article->databubble);

        echo '<pre>';
        var_dump($author->databubble);
        echo '</pre>';
    }

    public function example_29() {
        $CI =& get_instance();

        $main_databubble = $CI->databubbles_warehouse->create_databubble('main');

        $finder = new Finder('Article AS[alias_article]');
        $finder->where('alias_article:id', 1);
        $article = $finder->first($main_databubble);

        $finder = new Finder('Author AS[alias_author]');
        $finder->where('alias_author:id', 1);
        $author = $finder->first($main_databubble);

        echo '<pre>';
        var_dump($main_databubble);
        echo '</pre>';
    }

    public function example_30() {
        $CI =& get_instance();

        $now = Now::get_singleton()->get_value();

        $main_databubble = $CI->databubbles_warehouse->create_databubble('main');

        $finder = new Finder('Article AS[alias_article]');
        $finder->with('comments');
        $finder->where('alias_article:id', 1);
        $article = $finder->first($main_databubble);

        $finder = new Finder('Person AS[alias_person]');
        $finder->where('alias_person:id', 1);
        $person = $finder->first($main_databubble);

        $main_databubble->insert_model(
            'Comment',
            array(
                'content'     => 'The content of the comment',
                'article'     => $article,
                'person'      => $person,
                'created_at'  => new Mysql_datetime($now),
            )
        );

        echo '<pre>';
        var_dump($main_databubble);
        echo '</pre>';
    }

    public function example_31() {
        $CI =& get_instance();

        $main_databubble = $CI->databubbles_warehouse->create_databubble('main');

        $finder = new Finder('Author AS[alias_author]');
        $finder->where('alias_author:id', 1);
        $author = $finder->first($main_databubble);

        $finder = new Finder('Folder AS[alias_folder]');
        $finder->with('articles');
        $finder->where('alias_folder:name', 'folder 1-2');
        $folder = $finder->first($main_databubble);

        $status_draft = Status::find_by_name('DRAFT');

        $article = $main_databubble->insert_model(
            'Article',
            array(
                'status'      => $status_draft,
                'categories'  => ['technology', 'sport'],
                'author'      => $author,
                'folder'      => $folder,
                'created_at'  => new Mysql_datetime(),
            )
        );

        $main_databubble->insert_model(
            'Title',
            array(
                'content'  => 'The content of the title',
                'article'  => $article,
            )
        );

        $main_databubble->insert_model(
            'Paragraph',
            array(
                'content'   => 'The content of the paragraph 1',
                'position'  => 1,
                'article'   => $article,
            )
        );

        $main_databubble->insert_model(
            'Paragraph',
            array(
                'content'   => 'The content of the paragraph 2',
                'position'  => 2,
                'article'   => $article,
            )
        );

        var_dump_model($article);

        echo '<hr />';

        $finder = new Finder('Folder AS[alias_folder]');
        $finder->with('articles');
        $finder->where('alias_folder:name', 'folder 1-1-1');
        $new_folder = $finder->first($main_databubble);

        $article->set_assoc('folder', $new_folder);

        var_dump_model($article);

        echo '<hr />';

        var_dump_model($folder);

        echo '<hr />';

        var_dump_model($new_folder);

        echo '<hr />';

        $article->set_assoc('title', null);

        var_dump_model($article);

        echo '<hr />';

        $new_title = $main_databubble->insert_model(
            'Title',
            array(
                'content' => 'The content of the new title',
            )
        );

        $article->set_assoc('title', $new_title);

        var_dump_model($article);
    }

    public function example_32() {
        $CI =& get_instance();

        $main_databubble = $CI->databubbles_warehouse->create_databubble('main');

        $finder = new Finder('Article AS[alias_article]');
        $finder->with('comments');
        $finder->where('alias_article:id', 2);
        $article = $finder->first($main_databubble);

        var_dump_model($article);

        echo '<hr />';

        $finder = new Finder('Person AS[alias_person]');
        $finder->where('alias_person:id', 1);
        $person = $finder->first($main_databubble);

        $comment = $main_databubble->insert_model(
            'Comment',
            array(
                'content'     => 'The content of the comment',
                'person'      => $person,
                'created_at'  => new Mysql_datetime(),
            )
        );

        $article->add_assoc('comments', $comment);

        var_dump_model($article);

        echo '<hr />';

        $article->remove_assoc('comments', $comment);

        var_dump_model($article);
    }

    public function example_33() {
        $CI =& get_instance();

        $main_databubble = $CI->databubbles_warehouse->create_databubble('main');

        $finder = new Finder('Article AS[alias_article]');
        $finder->with('tags');
        $finder->where('alias_article:id', 2);
        $article = $finder->first($main_databubble);

        var_dump_model($article);

        echo '<hr />';

        $finder = new Finder('Tag AS[alias_tag]');
        $finder->where('alias_tag:id', 1);
        $tag_1 = $finder->first($main_databubble);

        $article->add_assoc(
            'tags',
            array(
                'tag'         => $tag_1,
                'created_at'  => new Mysql_datetime(),
            )
        );

        var_dump_model($article);

        echo '<hr />';

        $finder = new Finder('Tag AS[alias_tag]');
        $finder->where('alias_tag:id', 2);
        $tag_2 = $finder->first($main_databubble);

        $article->add_assoc(
            'tags',
            array(
                'tag'         => $tag_2,
                'created_at'  => new Mysql_datetime(),
            )
        );

        var_dump_model($article);

        echo '<hr />';

        $article->remove_assoc(
            'tags',
            array(
                'tag' => $tag_1,
            )
        );

        var_dump_model($article);

        echo '<hr />';

        $article->remove_assoc(
            'tags',
            array(
                'tag' => $tag_2,
            )
        );

        var_dump_model($article);
    }

    public function example_34() {
        $CI =& get_instance();

        $main_databubble = $CI->databubbles_warehouse->create_databubble('main');

        $finder = new Finder('Article AS[alias_article]');
        $finder->where('alias_article:id', 1);
        $article = $finder->first($main_databubble);

        $new_title = $main_databubble->insert_model(
            'Title',
            array(
                'content' => 'The content of the new title',
            )
        );

        $new_title->set_assoc('article', $article, false);
        $new_title->save(); // This is required because in the previous line, we set the third parameter $auto_commit to false

        var_dump_model($new_title);
    }

    public function example_35() {
        $article = Article::find(1);
        $article->add('categories', 'sport')
                ->save();

        var_dump_model($article);
    }

    public function example_36() {
        $article = Article::find(1);
        $article->remove('categories', 'sport')
                ->save();

        var_dump_model($article);
    }

    public function example_37() {
        $CI =& get_instance();

        $main_databubble = $CI->databubbles_warehouse->create_databubble('main');

        $finder = new Finder('Article AS[alias_article]');
        $finder->with('title');
        $finder->where('alias_article:id', 1);
        $article = $finder->first($main_databubble);

        var_dump_model($article);

        echo '<hr />';

        $main_databubble->delete_model($article->get_title());

        var_dump_model($article);
    }

    public function example_38() {
        $CI =& get_instance();

        $main_databubble = $CI->databubbles_warehouse->create_databubble('main');

        $finder = new Finder('Article AS[alias_article]');
        $finder->with('paragraphs');
        $finder->where('alias_article:id', 1);
        $article = $finder->first($main_databubble);

        $qm = new Query_manager();
        $qm->select_max('position', 'max_position')
           ->from('paragraph')
           ->where('article_id', $article->get_id());
        $query = $qm->get();
        $row = $query->row();
        $max_position = (int) $row->max_position;

        $paragraph = $main_databubble->insert_model(
            'Paragraph',
            array(
                'content'   => 'The content of the paragraph',
                'position'  => $max_position + 1,
                'article'   => $article,
            )
        );

        var_dump_model($article);

        echo '<hr />';

        $main_databubble->delete_model($paragraph);

        var_dump_model($article);
    }

    public function example_39() {
        $CI =& get_instance();

        $main_databubble = $CI->databubbles_warehouse->create_databubble('main');

        $finder = new Finder('Article AS[alias_article]');
        $finder->with('tags');
        $finder->where('alias_article:id', 1);
        $article = $finder->first($main_databubble);

        $tag = $main_databubble->insert_model(
            'Tag',
            array(
                'content' => 'tag',
            )
        );

        $tag->add_assoc(
            'articles',
            array(
                'article'     => $article,
                'created_at'  => new Mysql_datetime(),
            )
        );

        var_dump_model($article);

        echo '<hr />';

        $main_databubble->delete_model($tag);

        var_dump_model($article);
    }

    public function example_40() {
        $CI =& get_instance();

        $main_databubble = $CI->databubbles_warehouse->create_databubble('main');

        $finder = new Finder('Article AS[alias_article]');
        $finder->where_in('alias_article:status:name', ['DRAFT', 'ARCHIVED'])
               ->order_by('alias_article:status:name', 'ASC');
        $articles = $finder->get($main_databubble);

        var_dump_models($articles);
    }
}
