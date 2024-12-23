<?php
require_once('models/base/Model.php');
require_once('./views/components/FormUserView.phtml');

class Post extends Model
{
    // ** PROPIEDADES HEREDADAS DE MODEL **
    protected $entityName = "Post";
    protected $tableName = "post"; // como en base de datos
    protected $headers = ["Usuario", "Pregunta", "Tema", "Titulo", "Descripción", "Imagen", "Fecha", "Ámbito"];
    protected $columns = ["id_user", "id_post", "id_theme", "title", "text", "image", "timestamp", "scope"];

    // ** PROPIEDADES PROPIAS **
    private $id_user;
    private $id_post;
    private $id_theme;
    private $title;
    private $text;
    private $image;
    private $timestamp;
    private $scope;
    private $answers;

    // Constructor 
    public function __construct(
        $id = null,
        $id_post = null,
        $id_user = null,
        $id_theme = null,
        $title = null,
        $text = null,
        $image = null,
        $timestamp = null,
        $scope = null
    ) {
        $this->id = $id;
        $this->id_post = $id_post;
        $this->id_user = $id_user;
        $this->id_theme = $id_theme;
        $this->title = $title;
        $this->text = $text;
        $this->image = $image;
        $this->timestamp = $timestamp ?? date('Y-m-d H:i:s');
        $this->scope = $scope;
        $this->answers = PostRepository::getAllPosts($id);
    }



    //. ***** GETTERS *****
    public function getIdPost()
    {
        return $this->id_post;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getIdTheme()
    {
        return $this->id_theme;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getScope()
    {
        return $this->scope;
    }

    public function getAnswers()
    {
        return $this->answers;
    }



    //. ***** SETTERS *****
    public function setIdPost($id_post)
    {
        $this->id_post = $id_post;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function setIdTheme($id_theme)
    {
        $this->id_theme = $id_theme;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setImage($image)
    {

        $this->image = $image;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function setScope($scope)
    {
        $this->scope = $scope;
    }

    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }

    //. FUNCIONES PÚBLICAS 
    public function showAnswers($user_session)
    {
        if(!$this->answers){
            return false;
        }

        
        $html = '<ul>';
        foreach ($this->answers as $answer) {
            $html .= '<li>';
            $user = $answer->getUser();
            $html .= showUserInfo($user, $answer->getTimestamp(), $user_session->isAdmin());
            $html .= '  <p>' . $answer->getText() . '</p>';
            $html .= showInputResponse($answer);

            $html .= $answer->showAnswers($user_session);
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function getUser()
    {
        return UserRepository::getUserById($this->getIdUser());
    }
}
