<?php
class Policy
{

//DB stuff
    private $conn;
    private $table = 'policy';

//properties
    public $id;
    public $name;
    public $amount;

//construtor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

// read operation
    public function read()
    {

        $query = 'SELECT
              id,
              name,
              amount
              from
              ' . $this->table . '
              ORDER BY
              id DESC ';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

// insert operation
    public function insert()
    {
        $query = 'INSERT INTO ' .
        $this->table . '
               SET
               name = :name,
               amount = :amount';

        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':amount', $this->amount);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }

// update operation
    public function update()
    {
        $query = 'UPDATE ' .
        $this->table . '
               SET
               name = :name,
               amount = :amount
               WHERE
               id = :id';

        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':amount', $this->amount);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }

// delete operation
    public function delete()
    {
        $query = 'DELETE From ' .
        $this->table . '
                WHERE
               id = :id';

        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }
}
