<?php
class Model
{
    public $conn;
    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'online_shop');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function __destruct()
    {
        $this->conn->close();
    }
    public function admin($login, $pass)
    {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE login=? 
        AND password=?");
        $stmt->bind_param('ss', $login, $pass);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->num_rows;
    }
    public function add_category($name)
    {
        $query = $this->conn->prepare("INSERT INTO
         categories(name) VALUES(?)");
        $query->bind_param('s', $name);
        $query->execute();
    }
    public function get_categories()
    {
        $query = $this->conn->prepare("SELECT * FROM categories");
        $query->execute();
        $res = $query->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function get_cat_name_by_id($cat_id)
    {
        $query = $this->conn->prepare("SELECT name FROM categories WHERE id=?");
        $query->bind_param('i', $cat_id);
        $query->execute();
        $result = $query->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['name'];
        }

        return null;
    }
    public function update($id, $new_text)
    {
        $query = $this->conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $query->bind_param("si", $new_text, $id);
        $query->execute();
    }
    public function delete($id)
    {
        $query = $this->conn->prepare("DELETE FROM categories WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
    }
    public function add_products($cat_id, $name, $price, $desc, $img)
    {
        $query = $this->conn->prepare("INSERT INTO products(name,description,cat_id,image,price) VALUES(?,?,?,?,?)");
        $query->bind_param("ssisi", $name, $desc, $cat_id, $img, $price);
        $query->execute();
    }
    public function get_products($cat_id)
    {
        $query = $this->conn->prepare("SELECT * FROM products WHERE cat_id=?");
        $query->bind_param("i", $cat_id);
        $query->execute();
        $res = $query->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }
    public function update_product($name, $desc, $price, $id)
    {
        $query = $this->conn->prepare("UPDATE products SET name=?,description=?,price=? WHERE id = ?");
        $query->bind_param("ssii", $name, $desc, $price, $id);
        $query->execute();
        return $query->affected_rows > 0;
    }
    public function get_orders()
    {
        $query = "SELECT ord.*,pr.*,users.* FROM orders
        AS ord LEFT JOIN products AS pr ON ord.prod_id = pr.id
        RIGHT JOIN users ON ord.user_id=users.id";
        $res = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $result;
    }
    public function get_orders_grouped_by_users()
    {
        $stmt = $this->conn->prepare("
        SELECT users.name AS user_name, products.name AS product_name, orders.quantity, orders.created_date
        FROM orders
        JOIN users ON orders.user_id = users.id
        JOIN products ON orders.prod_id = products.id
        ORDER BY users.id, orders.created_date DESC
    ");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function delete_product($id)
    {
        $query = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
    }
}
$model = new Model();
