<div class="content">
         <div class="card">
<div class="inner">
<?php
class viewUser extends User{


    public function showPassword($username,$password){
        $datas = $this->getpassword($username,$password);
        
    }
    public function showAllarts(){
    $datas = $this->getAllarts();
    foreach ($datas as $data ){
        $category=$data['category'];
      //  echo $category;
        echo "<div class='box col-md-height col-md-4 col-xs-12'><div class='box-cell'><p><h2>{$data['artype']}</h2>
        <div class=' cim left group' style='max-width:350px;min-width:100%;padding:
        3px;box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);padding: 3px;margin-bottom: 40px;font-style: italic; 
        font-size: small;'>
        <div style='position: relative;padding-bottom: 7px;font-size: smaller;'>
        <div style='position:relative;width:100%; padding-top: 71.428571428571%'> 
        <div style='position:absolute;top: 0;left: 0;bottom: 0;right: 0;'>";

        if($category == 'Art'){
        echo '<img draggable="false" ondragstart="return false;" style="width:100%; height:110%" ';
        echo "src='{$data['img_link']}' srcset='{$data['img_link']} 350w, 
        /images/central-grasslands-263x188.jpg 263w, /images/central-grasslands-175x125.jpg 175w, /images/central-grasslands-88x63.jpg 88w, '
         sizes='(max-width: 350px) 305px,(max-width: 263px) 229px,(max-width: 175px) 152px,(max-width: 88px) 77px,'>";
    
        }
        else{
            echo "<iframe style='width:100%' height='110%' src='{$data['img_link']}'></iframe>";
        }
        echo "
         </div></div></div></div>";
         echo"
         <p>{$data['artinformation']}</p>";
         $artype=$data['artype'];
         echo "
         <a class='btn btn-outline-dark mt-auto' href='artcollection.php?artype=$artype'>More $artype art</a>        
         </p></div> 
         </div>";
    }
}
public function showTotalarts(){
    $datas = $this->Count();
    foreach ($datas as $data ){
        echo "<p>{$data['Total']} Different types of arts available </p>";
    }

}
public function showAllartypes(){
    $datas = $this->artypes();
    foreach ($datas as $data ){
        $artype=$data['artype'];
        echo"
        
        <li><a class='dropdown-item' href='artcollection.php?artype=$artype'>$artype</a></li>
        ";
    }

}









public function showAllPaint($artype){
    $datas = $this->getPaint($artype);
    foreach ($datas as $data ){

        $artid=$data['code'];
        $name=$data['artname'];
        $artype=$data['artype'];
        $price=$data['price'];
        $priceformat=number_format($price,2);
        echo "<div class='box col-md-height col-md-4 col-xs-12'><div class='box-cell'><p>
        <div class=' cim left group' style='
        3px;box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);padding: 1px;margin-bottom: 40px;font-style: italic; 
        font-size: small;'>
        <div style='position: relative;padding-bottom: 90px;font-size: smaller;'>
        <div style='position:relative;width:100%; padding-top: 71.428571428571%'> 
        <div style='position:absolute;top: 0;left: 0;bottom: 0;right: 0;'>";
        echo "<h5 Class='px-1 px-lg-5 my-3'><b>$name</b></h5>"; 
        $category=$data['category'];

        if($category == 'Art'){
            echo "<a href='artinformation.php?artId=$artid'>";
            echo '<img draggable="false" ondragstart="return false;" style="width:100%; height:110%" ';
            echo "src='{$data['img_link']}' srcset='{$data['img_link']} 350w, 
            /images/central-grasslands-263x188.jpg 263w, /images/central-grasslands-175x125.jpg 175w, /images/central-grasslands-88x63.jpg 88w, '
             sizes='(max-width: 350px) 305px,(max-width: 263px) 229px,(max-width: 175px) 152px,(max-width: 88px) 77px,'></a>";
            }
            else{
                echo "<a href='artinformation.php?artId=$artid'>";

                echo "<iframe style='width:100%' height='110%' src='{$data['img_link']}'></iframe> </a>";
            }
        
         echo "  
         </div></div></div></div>";
         echo "
         </p></div> ";
         echo "<P Class='px-1 px-lg-5 my-3'><b>Art price Ksh $priceformat </b></p>"; 
         echo"  </div>";
    }
}
public function showAllPaintings(){
    $datas = $this->getPainting();
    foreach ($datas as $data ){
        echo "
        <div class='container'>
        <img src='{$data['img_link']}' height='350px' style='width:100%;'>
        <div class='bottom-left'></div>
        <div class='top-left'></div>
        <div class='top-right'></div>
        <div class='bottom-right'><b>{$data['artype']} art</b></a></br>
              <b>{$data['artinformation']}.. 
              </b></br>
               <a href='artinformation.php'>More:-</a></div>
               <div class='centered'></div>
               </div>";
    }
}
public function showAllDrawing(){
    $datas = $this->getDrawing();
    foreach ($datas as $data ){
        echo "
        <div class='container'>
        <img src='{$data['img_link']}' height='350px' style='width:100%;'>
        <div class='bottom-left'></div>
        <div class='top-left'></div>
        <div class='top-right'></div>
        <div class='bottom-right'><b>{$data['artype']} art</b></a></br>
              <b>{$data['artinformation']}.. 
              </b></br>
               <a href='artinformation.php'>More:-</a></div>
               <div class='centered'></div>
               </div>";
    }
}

public function showAllPhotography(){
    $datas = $this->getPhotography();
    foreach ($datas as $data ){
        echo "
        <div class='container'>
        <img src='{$data['img_link']}' height='350px' style='width:100%;'>
        <div class='bottom-left'></div>
        <div class='top-left'></div>
        <div class='top-right'></div>
        <div class='bottom-right'><b>{$data['artype']} art</b></a></br>
              <b>{$data['artinformation']}.. 
              </b></br>
               <a href='artinformation.php'>More:-</a></div>
               <div class='centered'></div>
               </div>";
    }
}

public function showAllSculpure(){
    $datas = $this->getSculpture();
    foreach ($datas as $data ){
        echo "
        <div class='container'>
        <img src='{$data['img_link']}' height='350px' style='width:100%;'>
        <div class='bottom-left'></div>
        <div class='top-left'></div>
        <div class='top-right'></div>
        <div class='bottom-right'><b>{$data['artype']} art</b></a></br>
              <b>{$data['artinformation']}.. 
              </b></br>
               <a href='artinformation.php'>More:-</a></div>
               <div class='centered'></div>
               </div>";
    }
}

}
?>