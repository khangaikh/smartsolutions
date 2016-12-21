<?php
    require_once 'includes/Twig/Autoloader.php';
    require_once "config.php";
    use Parse\ParseObject;
    use Parse\ParseClient;
    use Parse\ParseQuery;
    use Parse\ParseUser;
    
    session_start();
    //register autoloader
    Twig_Autoloader::register();
    //loader for template files
    $loader = new Twig_Loader_Filesystem('templates');
    //twig instance
    $twig = new Twig_Environment($loader, array(
        'cache' => 'cache',
    ));
    //load template file
    $twig->setCache(false);

    if(isset($_GET['products'])){
        $template = $twig->loadTemplate('products.html');
        echo $template->render(array('title' => 'Products', 'nav' => 3));
        return;
    }
    if(isset($_GET['about'])){
        $template = $twig->loadTemplate('about.html');
        echo $template->render(array('title' => 'About', 'nav' => 4));
        return;
    }
    if(isset($_GET['contact'])){
        $template = $twig->loadTemplate('contact.html');
        echo $template->render(array('title' => 'Contact Us', 'nav' => 6));
        return;
    }
    if(isset($_GET['detail'])){
        $template = $twig->loadTemplate('detail.html');
        echo $template->render(array('title' => 'Detail', 'nav' => 3));
        return;
    }
    if(isset($_GET['solution'])){
        $template = $twig->loadTemplate('solutions.html');
        echo $template->render(array('title' => 'Solutions', 'nav' => 2));
        return;
    }
    if(isset($_GET['help'])){
        $template = $twig->loadTemplate('help.html');
        echo $template->render(array('title' => 'Help'));
        return;
    }
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        if(isset($_GET['logout'])){
            session_unset();
            session_destroy();
            $template = $twig->loadTemplate('main.html');
            //render a template
           echo $template->render(array('title' => 'See you agian')); 
        }else if(isset($_GET['friends'])){
            $template = $twig->loadTemplate('friends.html');
            echo $template->render(array('title' => 'My friends', 'user'=>$user, 'nav' => 5)); 
        }
        else if(isset($_GET['tree'])){
            $template = $twig->loadTemplate('my-tree.html');
            echo $template->render(array('title' => 'My friends', 'user'=>$user, 'nav' => 3)); 
        }
        else if(isset($_GET['nicethings'])){
            $template = $twig->loadTemplate('my-things.html');
            echo $template->render(array('title' => 'My nice things', 'user'=>$user, 'nav' => 2)); 
        }
        else if(isset($_GET['settings'])){
            $template = $twig->loadTemplate('settings.html');
            echo $template->render(array('title' => 'My settings', 'user'=>$user, 'nav' => 2)); 
        }
        else if(isset($_GET['dashboard'])){
            $template = $twig->loadTemplate('dashboard.html');
            echo $template->render(array('title' => 'Dashboard', 'user'=>$user, 'nav' => 1)); 
        }
        else if(isset($_GET['explore'])){
            $template = $twig->loadTemplate('explore.html');
            echo $template->render(array('title' => 'Explore', 'user'=>$user)); 
        }
        else if(isset($_GET['chat'])){
            $template = $twig->loadTemplate('chat.html');
            echo $template->render(array('title' => 'Explore', 'user'=>$user)); 
        }else if(isset($_GET['mymap'])){
            $template = $twig->loadTemplate('my-map.html');
            echo $template->render(array('title' => 'My map', 'user'=>$user)); 
        }
        else if(isset($_GET['reportnicething'])){
            $query = new ParseQuery("_User");
            $query->equalTo('status', 1);
            $users = $query->find();
            $template = $twig->loadTemplate('reportnicething.html');
            echo $template->render(array('title' => 'Report Nice Thing', 'users' => $users)); 
        }
        else{
            $template = $twig->loadTemplate('main.html');
            echo $template->render(array('title' => 'Start','user'=>$user)); 
        }
    }
    else{
        $template = $twig->loadTemplate('index.html');
        //$template = $twig->loadTemplate('my-things.html');
        echo $template->render(array('title' => 'Start', 'nav' =>1)); 
    }
?>

