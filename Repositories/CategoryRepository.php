<?php
namespace PhotoAlbum\Repositories;

use PhotoAlbum\Db;
use PhotoAlbum\Models\Category;

class CategoryRepository
{
    /**
     * @var \PhotoAlbum\Db
     */
    private $db;

    /**
     * @var CategoryRepository
     */
    private static $inst = null;

    private function __construct(\PhotoAlbum\Db $db)
    {
        $this->db = $db;
    }

    /**
     * @return CategoryRepository
     */
    public static function create()
    {
        if (self::$inst == null)
        {
            self::$inst = new self(Db::getInstance());
        }

        return self::$inst;
    }

    /**
     * @param $name
     * @return bool|Category
     */
    public function getOneByName($name)
    {
        $query = "SELECT id, name, user_id FROM categories WHERE name = ?";

        $this->db->query($query,
            [
                $name
            ]
        );

        $result = $this->db->row();

        if (empty($result)) return false;

        return $this->getOne($result['id']);
    }


    public function getOne($id)
    {
        $query = "SELECT id, name, user_id FROM categories WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $user = UserRepository::create()->getOne($result['user_id']);

        $category = new Category(
            $result['name'],
            $user,
            $result['id']
        );

        return $category;
    }

    /**
     * @return Category[]
     */
    public function getAll()
    {
        $query = "SELECT id, name, user_id FROM categories";

        $this->db->query($query);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $user = UserRepository::create()->getOne($row['user_id']);

            $collection[] = new Category(
                $row['name'],
                $user,
                $row['id']
            );
        }

        return $collection;
    }

    public function save(Category $category)
    {
        $query = "INSERT INTO categories (name, user_id) VALUES (?, ?)";
        $params = [
            $category->getName(),
            $category->getUser()->getId()
        ];

        if ($category->getId()) {
            $query = "UPDATE categories SET name = ?, user_id = ? WHERE id = ?";
            $params[] = $category->getId();
        }

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }
}