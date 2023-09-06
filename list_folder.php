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
   if($_POST['include_deleted'] == "" || $_POST['include_deleted'] == null)
   {
        $include_deleted_error = "include_deleted is Required";
   }
   else
   {
        $include_deleted = $_POST['include_deleted'];
   }
   if($_POST['include_has_explicit_shared_members'] == "" || $_POST['include_has_explicit_shared_members'] == null)
   {
        $include_has_explicit_shared_members_error = "include_has_explicit_shared_members is Required";
   }
   else
   {
        $include_has_explicit_shared_members = $_POST['include_has_explicit_shared_members'];
   }
   if($_POST['include_media_info'] == "" || $_POST['include_media_info'] == null)
   {
        $include_media_info_error = "include_media_info is Required";
   }
   else
   {
        $include_media_info = $_POST['include_media_info'];
   }
   if($_POST['include_mounted_folders'] == "" || $_POST['include_mounted_folders'] == null)
   {
        $include_mounted_folders_error = "include_mounted_folders is Required";
   }
   else
   {
        $include_mounted_folders = $_POST['include_mounted_folders'];
   }
   if($_POST['include_non_downloadable_files'] == "" || $_POST['include_non_downloadable_files'] == null)
   {
        $include_non_downloadable_files_error = "include_non_downloadable_files is Required";
   }
   else
   {
        $include_non_downloadable_files = $_POST['include_non_downloadable_files'];
   }
   if($_POST['path'] == "" || $_POST['path'] == null)
   {
        $path_error = "path is Required";
   }
   else
   {
        $path = $_POST['path'];
   }
   if($_POST['recursive'] == "" || $_POST['recursive'] == null)
   {
        $recursive_error = "recursive is Required";
   }
   else
   {
        $recursive = $_POST['recursive'];
   }

   if($access_token !='' && $include_deleted !='' && $include_has_explicit_shared_members !='' && $include_media_info !='' && $include_mounted_folders !='' && $include_non_downloadable_files !='' && $path !='' && $recursive !='')
   {
    $curl = curl_init();

    curl_setopt_array($curl, array(
     CURLOPT_URL => 'https://api.dropboxapi.com/2/files/list_folder',
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'POST',
     CURLOPT_POSTFIELDS =>'{
          "include_deleted": '.$include_deleted.',
          "include_has_explicit_shared_members": '.$include_has_explicit_shared_members.',
          "include_media_info": '.$include_media_info.',
          "include_mounted_folders": '.$include_mounted_folders.',
          "include_non_downloadable_files": '.$include_non_downloadable_files.',
          "path" : "/'.$path.'",
          "recursive": '.$recursive.'
   }',
     CURLOPT_HTTPHEADER => array(
       'Authorization: Bearer '.$access_token,
       'Content-Type: application/json'
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
	<title>List Folder and it's files</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
	<div class="container" style="margin-top : 30px">
		
		<div class="panel panel-info">
			
            <div class="panel-heading">
                <div class="panel-title">List Folder and it's files</div>
            </div>  
            <div class="panel-body" >
            	<form method="post" action="">
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Access Token</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="api_key"  name="access_token" style="margin-bottom: 10px" type="text" value=""/>
                       <p class="text-danger"><?php echo $access_token_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Include Deleted</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="include_deleted" style="margin-bottom: 10px" type="text" value="" placeholder="false"/>
                       <p class="text-danger"><?php echo $include_deleted_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Include Has Explicit Shared Memebers</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="include_has_explicit_shared_members" style="margin-bottom: 10px" type="text" value="" placeholder="false"/>
                       <p class="text-danger"><?php echo $include_has_explicit_shared_members_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Include Media Info</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="include_media_info" style="margin-bottom: 10px" type="text" value="" placeholder="false"/>
                       <p class="text-danger"><?php echo $include_media_info_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Include Mounted Folders</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="include_mounted_folders" style="margin-bottom: 10px" type="text" value="" placeholder="true"/>
                       <p class="text-danger"><?php echo $include_mounted_folders_error; ?></p>
                  </div>
                </div>
                <div id="user_id" class="form-group required">
                  <label for="user_id" class="control-label col-md-4  requiredField">Include Non Downloadable Files</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="include_non_downloadable_files" style="margin-bottom: 10px" type="text" value="" placeholder="true"/>
                       <p class="text-danger"><?php echo $include_non_downloadable_files_error; ?></p>
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
                  <label for="user_id" class="control-label col-md-4  requiredField">Recursive</label>
                  <div class="controls col-md-8 ">
                      <input class="input-md  textinput textInput form-control" id="user_id"  name="recursive" style="margin-bottom: 10px" type="text" value="" placeholder="false"/>
                       <p class="text-danger"><?php echo $recursive_error; ?></p>
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