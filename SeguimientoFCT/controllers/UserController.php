<?php
require_once 'models/user/UserRepository.php';
require_once './helpers/fileHelper.php';

if (isset($_POST['action'])) {
    switch ($_POST['action']) {

        case 'banear':
            $user = UserRepository::getUserById($_POST['id']);
            $user->setVisibility(0);

            $result = UserRepository::updateUser($user);

            if ($result) {
                echo mensaje("Usuario baneado");
            } else {
                echo mensaje("Error al banear el usuario");
            }
            exit;

        case 'edit':
            $user = isset($_POST['id']) && is_numeric($_POST['id']) 
                ? UserRepository::getUserById($_POST['id']) 
                : $user_session;

            require_once('views/user/EditProfile.phtml');
            break;

        case 'delete':
            $result = UserRepository::delete($_POST['id']);
            if ($result) {
                echo mensaje("Usuario eliminado");
            } else {
                echo mensaje("Error al eliminar el usuario");
            }
            exit;

        case 'update':
            $user = UserRepository::getUserById($_POST['id']);

            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = './public/img/avatars/';
                $fileName = FileHelper::generateUniqueName($_FILES['avatar']['name']);
                $filePath = $uploadDir . $fileName;

                if (FileHelper::fileHandler($_FILES['avatar']['tmp_name'], $filePath)) {
                    $user->setAvatar($fileName);
                } else {
                    echo mensaje("Error al subir el avatar");
                }
            }

            isset($_POST['username']) && $user->setUsername($_POST['username']);
            isset($_POST['email']) && $user->setEmail($_POST['email']);
            isset($_POST['bio']) && $user->setBio($_POST['bio']);
            isset($_POST['visibility']) && $user->setVisibility($_POST['visibility']);

            $result = UserRepository::updateUser($user);

            if ($result) {
                $_SESSION['user'] = $user;
                echo mensaje("Perfil actualizado correctamente");
            } else {
                echo mensaje("Error al actualizar el perfil");
            }
            exit;

        case 'createStudent':
            require_once('views/user/CreateStudent.phtml');
            break;

        case 'saveStudent':
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $student = UserRepository::register($username, $email, $password, -1);
            if ($student) {
                echo mensaje("Estudiante creado correctamente");
            } else {
                echo mensaje("Error al crear el estudiante");
            }
            break;

        case 'createTeacher':
            require_once('views/user/CreateTeacher.phtml');
            break;

        case 'saveTeacher':
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $teacher = UserRepository::register($username, $email, $password, 0);
            if ($teacher) {
                echo mensaje("Profesor creado correctamente");
            } else {
                echo mensaje("Error al crear el profesor");
            }
            break;

        default:
            echo mensaje("Acción no reconocida");
            break;
    }
} else {
    $user = UserRepository::getUserById($_POST['id']);
    ?>
    <div id="content">
      <?php
        if (isset($_POST['admin']) || $user->getId() === $user_session->getId()) {
          require_once('views/user/UserProfile.phtml');
        } else if (isset($user) && $user) {
            require_once('views/user/UserDetail.phtml');
        } else {
            ?>
            <h2>Perfil no encontrado</h2>
            <p>El perfil que buscas no está disponible o no existe.</p>
        <?php } ?>
    </div>
<?php
}
?>
