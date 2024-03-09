<?php

class Connection
{
    public PDO $pdo;

    public function __construct($dbname = 'laba_media')
    {
        $this->$dbname = $dbname;
        $this->pdo = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function get_datas($table_name)
    {
        $statment = $this->pdo->prepare("SELECT * FROM $table_name");
        $statment->execute();
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }


    public function get_data_by_id($id, $table_name)
    {
        $statment = $this->pdo->prepare("SELECT * FROM $table_name WHERE id = :id");
        $statment->bindValue('id', $id);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function delete_data($id, $table_name)
    {
        $statment = $this->pdo->prepare("DELETE FROM $table_name WHERE id = :id");
        $statment->bindValue('id', $id);
        return $statment->execute();
    }

    //* gallery methods

    public function add_to_gallery($gallery, $gallery_photo)
    {
        $statment = $this->pdo->prepare('INSERT INTO gallery (description, photo) VALUES (:description, :photo)');
        $statment->bindValue('description', $gallery['description']);
        $statment->bindValue('photo', $gallery_photo);

        return $statment->execute();
    }

    public function update_gallery($id, $gallery)
    {
        $statment = $this->pdo->prepare('UPDATE gallery SET description = :description WHERE id = :id');
        $statment->bindValue('id', $id);
        $statment->bindValue('description', $gallery['description']);
        $statment->execute();
    }

    //* gallery methods ended here

    //? about us methods 

    public function add_about_us($about_us, $about_us_photo)
    {
        $statment = $this->pdo->prepare("INSERT INTO about_us (title, description, image) VALUES (:title, :description, :image) ");
        $statment->bindValue('title', $about_us['title']);
        $statment->bindValue('description', $about_us['description']);
        $statment->bindValue('image', $about_us_photo);
        return $statment->execute();
    }

    public function update_about_us($id, $about_us)
    {
        $statment = $this->pdo->prepare('UPDATE about_us SET title = :title, description = :description WHERE id = :id');
        $statment->bindValue('id', $id);
        $statment->bindValue('title', $about_us['title']);
        $statment->bindValue('description', $about_us['description']);
        $statment->execute();
    }

    //? about us methods ended here

    //* more about us methods

    public function update_more_about_us($id, $more_about_us)
    {
        $statment = $this->pdo->prepare('UPDATE more_about_us SET why_us = :why_us, vision = :vision, goals = :goals WHERE id = :id');
        $statment->bindValue('id', $id);
        $statment->bindValue('why_us', $more_about_us['why_us']);
        $statment->bindValue('vision', $more_about_us['vision']);
        $statment->bindValue('goals', $more_about_us['goals']);
        $statment->execute();
    }

    //* more about us methods ended here

    //* testimonial method

    public function add_testimonial($testimonial, $testimonial_photo)
    {
        $statment = $this->pdo->prepare("INSERT INTO testimonials (name, company_name, testimony, photo) VALUES (:name, :company_name, :testimony, :photo)");
        $statment->bindValue("name", $testimonial['name']);
        $statment->bindValue("company_name", $testimonial['company_name']);
        $statment->bindValue("testimony", $testimonial['testimony']);
        $statment->bindValue("photo", $testimonial_photo);
        return $statment->execute();
    }

    public function update_testimonial($id, $testimonial)
    {
        $statment = $this->pdo->prepare("UPDATE testimonials SET name = :name, company_name = :company_name, testimony = :testimony WHERE id = :id");
        $statment->bindValue('id', $id);
        $statment->bindValue('name', $testimonial['name']);
        $statment->bindValue('company_name', $testimonial['company_name']);
        $statment->bindValue('testimony', $testimonial['testimony']);
        $statment->execute();
    }

    //* testimonial methods ended here


    public function hire_me($hire, $cv)
    {
        $statment = $this->pdo->prepare("INSERT INTO hiring (full_name, phone_number, email, address, about_you, work_time, gender, role, cv) VALUES (:full_name, :phone_number, :email, :address, :about_you, :work_time, :gender, :role, :cv)");
        $statment->bindValue("full_name", $hire['full_name']);
        $statment->bindValue("phone_number", $hire['phone_number']);
        $statment->bindValue("email", $hire['email']);
        $statment->bindValue("address", $hire['address']);
        $statment->bindValue("about_you", $hire['about_you']);
        $statment->bindValue("work_time", $hire['work_time']);
        $statment->bindValue("gender", $hire['gender']);
        $statment->bindValue("role", $hire['role']);
        $statment->bindValue("cv", $cv);
        return $statment->execute();
    }
}
