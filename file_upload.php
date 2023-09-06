<?php
$allData = array();
if(isset($_REQUEST['submit']))
{
   if($_POST['access_token'] == "" || $_POST['access_token'] == null)
   {
        $access_token_error = "access_token is Required";
   }
   else
   {
        $access_token = $_POST['access_token'];
   }
   if($_POST['autore_name'] == "" || $_POST['autore_name'] == null)
   {
        $autore_name_error = "autore_name is Required";
   }
   else
   {
        $autore_name = $_POST['autore_name'];
   }
   if($_POST['mute'] == "" || $_POST['mode'] == null)
   {
        $mode_error = "mode is Required";
   }
   else
   {
        $mode = $_POST['mode'];
   }
   if($_POST['mute'] == "" || $_POST['mute'] == null)
   {
        $mute_error = "mute is Required";
   }
   else
   {
        $mute = $_POST['mute'];
   }
   if($_POST['path'] == "" || $_POST['path'] == null)
   {
        $path_error = "path is Required";
   }
   else
   {
        $path = $_POST['path'];
   }
   if($_FILES['file']['tmp_name'] == "" || $_FILES['file']['tmp_name'] == null)
   {
        $file_error = "file is Required";
   }
   else
   {
        $file = $_FILES['file']['tmp_name'];
   }
   if($_POST['strict_conflict'] == "" || $_POST['strict_conflict'] == null)
   {
        $strict_conflict_error = "strict_conflict is Required";
   }
   else
   {
        $strict_conflict = $_POST['strict_conflict'];
   }

   if($access_token !='' && $autore_name !='' && $mode !='' && $mute !='' && $path !='' && $file !='' && $strict_conflict !='')
   {
    $imageName = $_FILES['file']['name'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
     CURLOPT_URL => 'https://content.dropboxapi.com/2/files/upload',
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'POST',
     CURLOPT_POSTFIELDS => file_get_contents($_FILES['file']['tmp_name']),
     CURLOPT_HTTPHEADER => array(
       'Authorization: Bearer '.$access_token,
       'Dropbox-API-Arg: {"autorename":'.$autore_name.',"mode":"'.$mode.'","mute":'.$mute.',"path":"/'.$path.'/'.$imageName.'","strict_conflict":'.$strict_conflict.'}',
       'Content-Type: application/octet-stream'
     ),
   ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $allData = $response;
    }
   }
   
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload File</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
	<div class="container" style="margin-top : 30px">
		
		<div class="panel panel-info">
			
            <div class="panel-heading">
                <div class="panel-title">Upload File</div>
            </div>  
            <div class="panel-body" >
            	<form method="post" action="" enctype="multipart/form-data">
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Access Token</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="api_key"  name="access_token" style="margin-bottom: 10px" type="text" value=""/>
                       <p class="text-danger"><?php echo $access_token_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Autore Name</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="autore_name" style="margin-bottom: 10px" type="text" value="" placeholder="false"/>
                       <p class="text-danger"><?php echo $autore_name_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Mode</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="mode" style="margin-bottom: 10px" type="text" value="add" placeholder="" readonly/>
                       <p class="text-danger"><?php echo $mode_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Mute</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="mute" style="margin-bottom: 10px" type="text" value="" placeholder="false"/>
                       <p class="text-danger"><?php echo $mute_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Path</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="path" style="margin-bottom: 10px" type="text" value="" placeholder="test"/>
                       <p class="text-danger"><?php echo $path_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Strict Conflict</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="strict_conflict" style="margin-bottom: 10px" type="text" value="" placeholder="false"/>
                       <p class="text-danger"><?php echo $strict_conflict_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">File</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="file" style="margin-bottom: 10px" type="file"/>
                       <p class="text-danger"><?php echo $file_error; ?></p>
                  </div>
                </div>
                <div class="form-group"> 
                    <div class="aab controls col-md-4 "></div>
                    <div class="controls col-md-8 ">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary btn btn-info" id="submit-id-signup" />
                    </div>
                </div> 
            	</form>	
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Result</div>
            </div>
            <div class="panel-body" >
                <?php
                    echo $allData;
                ?>
            </div>
        </div>
	</div>
</body>
</html>