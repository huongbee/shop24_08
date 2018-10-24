<?php
include_once 'BaseController.php';
include_once 'model/IndexModel.php';

class IndexController extends BaseController{
    
    function getHomePage(){
        $model = new IndexModel();
        $slide = $model->selectSlide();
        
        $data = [
            'slide' => $slide
        ];
        return $this->loadView('index',$data);
    }
}

?>