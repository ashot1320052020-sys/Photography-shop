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
    public function get_categories()
    {
        $query = $this->conn->prepare("SELECT * FROM categories");
        $query->execute();
        $res = $query->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }
    public function get_products($cat_id)
    {
        $query = $this->conn->prepare("SELECT * FROM products WHERE cat_id = ?");
        $query->bind_param("i", $cat_id);
        $query->execute();
        $res = $query->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    /////////////////////////
    public function  add_user($name, $login, $pass, $email)
    {
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        $query = $this->conn->prepare("INSERT INTO users (name, login,password,email)VALUES(?,?,?,?)");
        $query->bind_param('ssss', $name, $login, $hashed_pass, $email);
        return $query->execute();
    }
    public function  check_user($email)
    {
        $query = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $query->store_result();
        return $query->num_rows;
    }
    public function check_login($email, $pass)
    {
        $query = $this->conn->prepare("SELECT * FROM users WHERE email=?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        $user = $result->fetch_assoc();
        if ($user && password_verify($pass, $user['password'])) {
            return $user;
        }
        return null;
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
    public function get_product_name_by_id($product_id)
    {
        $query = $this->conn->prepare("SELECT name FROM products WHERE id=?");
        $query->bind_param('i', $product_id);
        $query->execute();
        $result = $query->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['name'];
        }

        return null;
    }
    public function add_to_cart($user_id, $prod_id, $quantity)
    {
        $query = "INSERT INTO cart VALUES(null,$user_id,$prod_id,$quantity)";
        $res = mysqli_query($this->conn, $query);
    }
    public function check_cart($user_id, $prod_id)
    {
        $query = $this->conn->prepare('SELECT *
         FROM cart WHERE user_id=? AND product_id=?');
        $query->bind_param('ii', $user_id, $prod_id);
        $query->execute();
        $result = $query->get_result();
        $res = $result->fetch_all(MYSQLI_ASSOC);
        return $res ? $res : false;
    }
    public function check_cart_quantity($user_id, $prod_id)
    {
        $query = $this->conn->prepare("SELECT quantity
         FROM cart WHERE user_id=? AND product_id=?");
        $query->bind_param('ii', $user_id, $prod_id);
        $query->execute();
        $result = $query->get_result();
        $res = $result->fetch_assoc();
        return $res ? $res['quantity'] : 0;
    }
    public function update_cart_quantity($user_id, $prod_id, $quantity)
    {
        $query = $this->conn->prepare("UPDATE cart SET quantity = ?
        WHERE user_id=? AND product_id=?");
        $query->bind_param('iii', $quantity, $user_id, $prod_id);
        $query->execute();
    }
    public function get_cart_items($user_id)
    {
        $query = $this->conn->prepare(
            "SELECT name,price,image,quantity,description,cart.id,product_id,user_id
            FROM cart JOIN products ON product_id=products.id WHERE user_id=?"
        );
        $query->bind_param('i', $user_id);
        $query->execute();
        $result = $query->get_result();
        $res = $result->fetch_all(MYSQLI_ASSOC);
        return $res;
    }
    public function update_cart($user_id, $id, $quantity)
    {
        $query = $this->conn->prepare("UPDATE cart SET quantity=? WHERE id=? AND user_id=?");
        $query->bind_param("iii", $quantity, $id, $user_id);
        return $query->execute();
    }
    public function delete($user_id, $id)
    {
        $query = $this->conn->prepare("DELETE FROM cart WHERE user_id=? AND id=?");
        $query->bind_param("ii", $user_id, $id);
        $query->execute();
    }
    public function add_to_order($user_id)
    {
        $today = date("Y-m-d");
        $query = "SELECT * FROM cart WHERE user_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $query_next = "INSERT INTO orders VALUE(NULL,?,?,?,?)";
        $stmt_next = $this->conn->prepare($query_next);
        foreach ($res as $row) {
            $prod_id = $row['product_id'];
            $quantity = $row['quantity'];
            $stmt_next->bind_param('iiis', $user_id, $prod_id, $quantity, $today);
            $stmt_next->execute();
        }
        return true;
    }
    public function get_order($user_id)
    {
        $query = "SELECT ord.*,pr.* FROM orders as ord
        LEFT JOIN products as pr ON ord.prod_id=pr.id 
        WHERE ord.user_id='$user_id'";
        $res = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $result;
    }
}
$user_model = new Model();
