<?php


include_once(__DIR__ . "/Db.php");

class Upload
{

    private $title;
    private $description;
    private $tags;
    private $file;


    public function image_upload()
    {

        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];
        $folder = "images/upload/" . $filename;
        if (move_uploaded_file($tempname, $folder)) {
            print_r("Image uploaded successfully");
        } else {
            print_r("Failed to upload image");
        }

        $conn = Db::getConnection();

        $statement = $conn->prepare("insert into post (title, description, tags, file) values (:title, :description, :tags, :file)");

        $title = $this->getTitle();
        $description = $this->getDescription();
        $tags = $this->getTags();
        $file = $this->getFile();

        $statement->bindValue(":title", $title);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":tags", $tags);
        $statement->bindValue(":file", $file);

        $result = $statement->execute();
        return $result;

    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }

}