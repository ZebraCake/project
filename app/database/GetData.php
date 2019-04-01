<?php

namespace App\Database;


class GetData
{
    private $pdo;

    public function __construct ($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUrl()
    {
        $url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        return $url;
    }

    public function getPages() {
        $query = "SELECT COUNT(*) FROM `post`";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $result = $result->fetchAll();
        $total_pages = ceil($result[0][0] / 10);

        return $total_pages;
    }

    public function getCountPost() {
        $query = "SELECT * FROM `post`";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $result = $result->fetchAll();
        $total_pages = count($result);

        return $total_pages;
    }

    public function getCategories()
    {
        $query = "SELECT * FROM `categories`";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $result = $result->fetchAll();
        $html = '';
        foreach ($result as $item) {
            $html .= "
                <div class=\"category-block\">
                    <a href=\"/?category={$item['id']}\">{$item['name']}</a>
                </div>
                ";
        }
        return $html;
    }

    public function getPostsFromCategories($id)
    {
        $query = "SELECT `post`.*, `categories`.*, `user`.*, `post`.`id` AS `post_id` FROM `post` 
                  LEFT JOIN `categories` ON `post`.`category_id` = `categories`.`id` 
                  LEFT JOIN `user` ON `post`.`user_id` = `user`.`id` WHERE `post`.`category_id` = :cat_id";

        $result = $this->pdo->prepare($query);
        $result->bindValue('cat_id', (int)$id);
        $result->execute();
        $result = $result->fetchAll();

        if (empty($result)) {
            header("Location: /");
        } else {
            $html = '';
            foreach ($result as $item) {
                $html .= "
                    <section class=\"news\">
                        <div class=\"image\">
                            <a href=\"/?post={$item['post_id']}\"><img src=\"assets/images/{$item['image']}\" alt=\"news image\"></a>
                        </div>
                        <div class=\"news-name\">
                            {$item['title']}
                        </div>
                        <div class=\"news-information\">
                            <div class=\"info-item\">
                                <span>{$item['date']}</span>
                            </div>
                            <div class=\"info-item\">
                                <span>{$item['user_name']}</span>
                            </div>
                            <div class=\"info-item\">
                                <span>{$item['name']}</span>
                            </div>
                        </div>
                        <div class=\"news-description\">
                            <p>{$item['description']}</p>
                        </div>
                        <div class=\"news-target\">
                            <a href=\"/?post={$item['post_id']}\">Подробнее</a>
                        </div>
                    </section>
                ";
            }
        }
        return $html;
    }

    public function getAllPosts()
    {
        $total_post = $this->getCountPost();
        $total_pages = ceil($total_post / 10);
        $page = $_GET['page'] ?? 1;
        $next_page = $page + 1;
        $prev_page = $page - 1;
        $two_next_page = $page + 2;
        $two_prev_page = $page - 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $query = "SELECT `post`.*, `categories`.*, `user`.*, `post`.`id` AS `post_id` 
                  FROM `post` JOIN `categories` ON `post`.`category_id` = `categories`.`id` 
                  JOIN `user` ON `post`.`user_id` = `user`.`id` ORDER BY `date` DESC LIMIT {$offset}, {$limit}";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $result = $result->fetchAll();

        $html = '';

        foreach ($result as $item) {
            $html .= "
                <section class=\"news\">
                    <div class=\"image\">
                        <a href=\"/?post={$item['post_id']}\"><img src=\"assets/images/{$item['image']}\" alt=\"news image\"></a>
                    </div>
                    <div class=\"news-name\">
                        {$item['title']}
                    </div>
                    <div class=\"news-information\">
                        <div class=\"info-item\">
                            <span>{$item['date']}</span>
                        </div>
                        <div class=\"info-item\">
                            <span>{$item['user_name']}</span>
                        </div>
                        <div class=\"info-item\">
                            <span>{$item['name']}</span>
                        </div>
                    </div>
                    <div class=\"news-description\">
                        <p>{$item['description']}</p>
                    </div>
                    <div class=\"news-target\">
                        <a href=\"/?post={$item['post_id']}\">Подробнее</a>
                    </div>
                </section>
                
            ";
        }
        if ($page == $total_pages) {
                $html .= "
                    <section class=\"nav-list\">
                        <div class=\"first-page\">
                            <a href=\"/?page=1\"></a>
                        </div>
                        <div class=\"number-pages\">
                            <a href=\"/?page=" . ($page - 2) . "\">" . ($page - 2) . "</a>
                            <a href=\"/?page=" . ($page - 1) . "\">" . ($page - 1) . "</a>
                            <a href=\"/?page={$page}\" class=\"disabled selected\">{$page}</a>
                        </div>
                        <div class=\"last-page\">
                            <a href=\"#\" style=\"visibility: hidden\"></a>
                        </div>
                    </section>";
        } elseif ($page < $total_pages && $page > 1) {
            $html .= "
                    <section class=\"nav-list\">
                        <div class=\"first-page\">
                            <a href=\"/?page=1\"></a>
                        </div>
                        <div class=\"number-pages\">
                            <a href=\"/?page={$prev_page}\">{$prev_page}</a>
                            <a href=\"/?page={$page}\" class=\"disabled selected\">{$page}</a>
                            <a href=\"/?page={$next_page}\" >{$next_page}</a>
                        </div>
                        <div class=\"last-page\">
                            <a href=\"/?page={$total_pages}\"></a>
                        </div>
                    </section>";
        } else {
            $html .= "
                    <section class=\"nav-list\">
                        <div class=\"first-page\">
                            <a href=\"#\" style=\"visibility: hidden\"></a>
                        </div>
                        <div class=\"number-pages\">
                            <a href=\"/?page={$page}\" class=\"disabled selected\">{$page}</a>
                            <a href=\"/?page={$next_page}\">{$next_page}</a>
                            <a href=\"/?page={$two_next_page}\" >{$two_next_page}</a>
                        </div>
                        <div class=\"last-page\">
                            <a href=\"/?page={$total_pages}\"></a>
                        </div>
                    </section>";
        }
        return $html;
    }

    public function getPost($id)
    {
        $query = "SELECT * FROM `post` LEFT JOIN `user` ON `post`.`user_id` = `user`.`id` WHERE `post`.`id` = :post_id";
        $result = $this->pdo->prepare($query);
        $result->bindValue('post_id', (int)$id);
        $result->execute();
        $result = $result->fetchAll();

        if(empty($result)) {
            header("Location: /");
        } else {
            $html = '';
            foreach ($result as $item) {
                $html .= "
                    <section class=\"post-page\">
                        
                        <h1>{$item['title']}</h1>
                        <div class=\"post-page-info\">
                            <span>{$item['date']}</span>
                            <span>{$item['user_name']}</span>
                        </div>
                        <img src=\"assets/images/{$item['image']}\" alt=\"\">                   
                        {$item['content']}
                        <div class=\"fb-comments\" data-href=\"{$this->getUrl()}\" data-width=\"100%\" data-numposts=\"5\"></div>
                    </section>
                ";
            }
        }
        return $html;

    }

    public function findText($text)
    {
        $query = "SELECT `post`.*, `categories`.*, `user`.*, `post`.`id` AS `post_id` 
                  FROM `post` JOIN `categories` ON `post`.`category_id` = `categories`.`id` 
                  JOIN `user` ON `post`.`user_id` = `user`.`id` 
                  WHERE `description` LIKE :text OR `title` LIKE :text OR `content` LIKE :text";
        $result = $this->pdo->prepare($query);
        $result->bindValue('text', '%'.$text.'%');
        $result->execute();
        $result = $result->fetchAll();

        $html = '';
        if(empty($result)) {
            $html = '<h1>Записи не найдены</h1><br><p>Повторите запрос</p>';
        } else {
            $html .= "<h2>Результаты поиска:</h2><span>Записей найдено: " . count($result) .".</span><br><br>";
            foreach ($result as $item) {
                $html .= "
                <section class=\"news\">
                    <div class=\"image\">
                        <a href=\"/?post={$item['post_id']}\"><img src=\"assets/images/{$item['image']}\" alt=\"news image\"></a>
                    </div>
                    <div class=\"news-name\">
                        {$item['title']}
                    </div>
                    <div class=\"news-information\">
                        <div class=\"info-item\">
                            <span>{$item['date']}</span>
                        </div>
                        <div class=\"info-item\">
                            <span>{$item['user_name']}</span>
                        </div>
                        <div class=\"info-item\">
                            <span>{$item['name']}</span>
                        </div>
                    </div>
                    <div class=\"news-description\">
                        <p>{$item['description']}</p>
                    </div>
                    <div class=\"news-target\">
                        <a href=\"/?post={$item['post_id']}\">Подробнее</a>
                    </div>
                </section>
            ";
            }

        }
        return $html;
    }

}