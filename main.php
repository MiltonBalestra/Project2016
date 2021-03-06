<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
prefix="
  schema: http://schema.org/
  prism: http://prismstandard.org/namespaces/basic/2.0/
  dcterms: http://purl.org/dc/terms/">
<head>
    <title>EasyRASH</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/rash.css" />
    <link rel="stylesheet" type="text/css" href="css/style-article.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/global_var.js"></script>
    <script type="text/javascript" src="js/menu.js"></script>
    <script type="text/javascript" src="js/eventmanager.js"></script>
</head>
<body>
    <div class="container-fluid">
		<?php
			if(isset($_SESSION['changeError'])){ 
				$message= " ";
				switch($_SESSION['changeError']){
					case 0:
						$message = "Account successfully edited.";
						break;
					case 1:
						$message = "ERROR: Email address already in use.";
						break;
					case 2:
						$message = "ERROR: Password is not correct.";
						break;
				}
			?>
			<div class="alert alert-info">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong><?php echo $message; ?></strong>
		</div>
		<?php } ?>	
		
        <!-- NAV !-->
        <div class="row noselect">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="#">Rash Project</a>
						</div>
						<div class="collapse navbar-collapse">
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a id="utente" class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="carret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="#" type="button" class="btn" data-toggle="modal" onclick="logModal();">Account configuration</a></li>
									</ul>
								</li>
								<li><a href="php/logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
							</ul>
						</div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- BODY !-->
        <div class="row">
          <!-- ASIDE !-->
        	<div  class="col-xs-12 col-sm-3 col-md-3 col-lg-3 noselect" style="padding-top: 10px;z-index:1001">
				<div class="dropdown">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Select events
						<span class="caret"></span>
					</button>
					<ul id="events" class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li class="dropdown-header">Events</li>
					</ul>
				</div>
				<div id="articles" class="list-group"></div>
				<div class="container-fluid"><p>Annotations</p></div>
				<div id="annotationsMenu" class="list-group"></div>
			</div>
            <!-- SECTION !-->
            <div class="col-sm-9 col-md-9 col-lg-9">
                <nav class="navbar noselect">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Actions<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" type="button" class="btn" data-toggle="modal" onclick="beginAnnotation();">Create Annotation</a></li>
                                        <li><a href="#" type="button" class="btn" data-toggle="modal" data-target="#reviewArticle">Review Article</a></li>
                                        <li><a href="#" type="button" class="btn" data-toggle="modal" data-target="#chairArticle">Chair Article</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" onclick="storeAnnotation()">Save Changes</a>
                                </li>
                                <li>
                                    <a href="#">Filter annotation type</a>
                                </li>
                                <li>
                                    <a href="#">Annotator</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- PAPERDIV !-->
                <div id="RASHhead"></div>
                <div id="paperdiv" class="col-sm-9 col-md-9 col-lg-9" onmouseup="Highlight()"></div>
            </div>
            <!-- Modal -->
            <div id="createAnnotation" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Create Annotation</h4>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" style="min-width: 100%" id="textCREATE" placeholder="Insert your annotation here." autofocus></textarea>
                        </div>
                        <div class="modal-footer">
                            <button onclick="creaAnnotation(document.getElementById('textCREATE').value)" class="btn btn-default btn-success" data-dismiss="modal">Ok</button>
                            <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modifyAnnotation" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modify Annotation</h4>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" style="min-width: 100%" id="textMODIFY" placeholder="Insert your annotation here."></textarea>
                        </div>
                        <div class="modal-footer">
                            <button onclick="modifyAnnotation(document.getElementById('textMODIFY').value)" class="btn btn-default btn-success" data-dismiss="modal">Ok</button>
							<button onclick="deleteAnnotation()" class="btn btn-default btn-danger" data-dismiss="modal">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="reviewArticle" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Vote Article</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <div class="row">
                                <textarea class="form-control" style="min-width: 100%" id="opinion" placeholder="Insert your opinion here."></textarea>
                                <h3>Select your vote</h3>
                                <div class="large-12 columns" style="text-align: center;display: inline-block;">
                                    <div class="btn-group" id="score-review" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" name="options" value="1" autocomplete="off" checked >
                                            1
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="options" value="2" autocomplete="off" >
                                            2
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="options" value="3" autocomplete="off" >
                                            3
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="options" value="4" autocomplete="off" >
                                            4
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="options" value="5" autocomplete="off" >
                                            5
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button onclick="storeReview(document.getElementById('opinion').value)" class="btn btn-default btn-success" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="chairArticle" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Vote Article</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <div class="row">
                                <textarea class="form-control" style="min-width: 100%" id="opinion" placeholder="Insert your opinion here."></textarea>
                                <div class="large-12 columns" style="text-align: center;display: inline-block;">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-success active">
                                            <input type="radio" name="options" value="1" autocomplete="off" checked />
                                            Accept
                                        </label>
                                        <label class="btn btn-danger">
                                            <input type="radio" name="options" value="2" autocomplete="off" />
                                            Reject
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default btn-success">Ok</button>
                                <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id="logModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content--> 
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 style="color:red;">
								<span class="glyphicon glyphicon-lock"></span>
								Account configuration
							</h4>
						</div>
						<div class="modal-body">
							<form role="form" action="php/change.php" method="post">
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" name="name" id="name" tabindex="1" class="form-control" required autofocus>
								</div>
								<div class="form-group">
									<label for="surname">Surname</label>
									<input type="text" name="surname" id="surname" tabindex="2" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" name="email" id="email" tabindex="3" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="password">Password <span><a href="#" type="button" class="btn" id="changePass" onclick="showPassFields()">(change)</a></span></label>
									<input type="password" name="oldPass" id="password" tabindex="4" class="form-control" placeholder="Old password" style="display: none">
								</div>
								<div class="form-group">
									<input type="password" name="newPass" id="newPassword" tabindex="5" class="form-control" placeholder="New Password" style="display: none">
								</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-default btn-success" tabindex="6">Save</button>
										<button type="button" class="btn btn-default btn-danger" data-dismiss="modal" tabindex="7" onclick="hidePassFields()">Cancel</button>
								</div>
							</form>
						</div>
					</div>
				</div>
        	</div>
	   </div>
    </div>
</body>
</html>
