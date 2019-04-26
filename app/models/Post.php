<?php 
class Post{
    //private properties
    private $db;

    //constructor
    public function __construct(){
        $this->db = new Database;
    }


    //get posts function 
    public function getPosts(){
        $this->db->query('SELECT users.id, users.name,posts.id AS postId,posts.body,
                                 posts.user_id, posts.title, posts.created_at
                                FROM 
                                 posts, users WHERE users.id = posts.user_id');

        $results = $this->db->resultSet();

        return $results;
    }

    // add post function
    public function addPost($data){
        $this->db->query('INSERT INTO posts (title, user_id, body) VALUES(:title, :user_id, :body)');
        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
    }

     // update post method
     public function updatePost($data){
        $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
    }

     // delete post method
     public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
    }

    public function getPostById($id){
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        $row =  $this->db->single();

        return $row;
    }
}