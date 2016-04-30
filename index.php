<!DOCTYPE html>
<html lang="it">
<head>
	<title>EasyRASH</title>
	<meta charset="utf-8">
	<!--<link rel="stylesheet" type="text/css" href="styles/style.css">!-->
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="menu.js"></script>
	<script>
		var arr;
		// funzione caricata all'apertura della pagina
		$(document).ready(function (e) {
			var text = $("#data").html();
			arr = JSON.parse(text);
			//alert(arr.events[0]['conference']);
			for(var i = 0; i < arr.events.length; i++){
				$('#events').append('<li><a href="#" data-id="' + i + '" onclick="selectEvent(this)" >'+arr.events[i]['conference']+'</a></li>');
			}
		});
		function selectEvent(identifier) {
			var id = $(identifier).attr("data-id");
			var submissions = arr.events[id]['submissions'];
			var tmp = "";
			for(var i = 0; i < submissions.length; i++){
				tmp += '<a href="#" class="list-group-item" data-id="' + submissions[i]['id'] + '" onclick="openArticle(this)">'+submissions[i]['title']+'</a>';
			}
			$("#articles").html(tmp);
		}
		function openArticle(identifier){
			$("#article").attr("src", "prova4.html");
		}
		var annotations = [{}]
		function storeAnnotation(text){
			annotations.push(
			{
				"@context": "easyrash.json",
				"@type": "comment",
				"@id": "#article1",
				"text": text,
				"ref": "#id_element",
				"author": "mailto:john@smith.com",
				"date": Date.now()
			});
			//date:  "2016-01-16T11:54:26"
			var text = JSON.stringify(annotations);
			alert(text);
		}
		function storeScore(text){
			annotations.push(
			{
				"@context": "easyrash.json",
				"@type": "score",
				"@id": "#article1",
				"text": text,
				"ref": "#id_element",
				"author": "mailto:john@smith.com",
				"date": Date.now()
			});
			//date:  "2016-01-16T11:54:26"
			var text = JSON.stringify(annotations);
			alert(text);
		}
		function storeOpinion(text){
			annotations.push(
			{
				"@context": "easyrash.json",
				"@type": "opinion",
				"@id": "#article1",
				"text": text,
				"ref": "#id_element",
				"author": "mailto:john@smith.com",
				"date": Date.now()
			});
			//date:  "2016-01-16T11:54:26"
			var text = JSON.stringify(annotations);
			alert(text);
		}
		function storeDecision(text){
			annotations.push(
			{
				"@context": "easyrash.json",
				"@type": "decision",
				"@id": "#article1",
				"text": text,
				"ref": "#id_element",
				"author": "mailto:john@smith.com",
				"date": Date.now()
			});
			//date:  "2016-01-16T11:54:26"
			var text = JSON.stringify(annotations);
			alert(text);
		}
	</script>
	<script id="data" type=”application/ld+json”>
	{ 
		"events": [{
			"conference": "International Semantic Web Conference 2016",
			"acronym": "ISWC 2016",
			"chairs": 
			[
				"John Smith <john@smith.com>", 
				"Steve Green <steve@green.com>"
			],
			"pc_members": 
			[{
				"name": "Silvio Peroni <silvio@peroni.it>",
				"assignments": ["1", "5", "7"],
				"done": ["5", "7"]
			}],
			"submissions": 
			[
			{
				"id": "1",
				"title": "Some stuff",
				"authors": ["Mary Lamb <mary@lamb.com>"],
				"url": "http://xxx/filename.html",
				"reviewers": 
				[
					"Silvio Peroni <silvio@peroni.it>",
					"Angelo Di Iorio <angelo@diiorio.it>"
				],
				"done": ["Angelo Di Iorio <angelo@diiorio.it>"]
			},
			{
				"id": "2",
				"title": "Some stuff2",
				"authors": ["Mary Lamb <mary@lamb.com>"],
				"url": "http://xxx/filename.html",
				"reviewers": 
				[
					"Silvio Peroni <silvio@peroni.it>",
					"Angelo Di Iorio <angelo@diiorio.it>"
				],
				"done": ["Angelo Di Iorio <angelo@diiorio.it>"]
			}
			]
		},
		{
			"conference": "Web Conference 2",
			"acronym": "ISWC 2016",
			"chairs": 
			[
				"John Smith <john@smith.com>", 
				"Steve Green <steve@green.com>"
			],
			"pc_members": 
			[{
				"name": "Silvio Peroni <silvio@peroni.it>",
				"assignments": ["1", "5", "7"],
				"done": ["5", "7"]
			}],
			"submissions": 
			[
			{
				"id": "1",
				"title": "Article 1",
				"authors": ["Mary Lamb <mary@lamb.com>"],
				"url": "http://xxx/filename.html",
				"reviewers": 
				[
					"Silvio Peroni <silvio@peroni.it>",
					"Angelo Di Iorio <angelo@diiorio.it>"
				],
				"done": ["Angelo Di Iorio <angelo@diiorio.it>"]
			},
			{
				"id": "2",
				"title": "Article 2",
				"authors": ["Mary Lamb <mary@lamb.com>"],
				"url": "http://xxx/filename.html",
				"reviewers": 
				[
					"Silvio Peroni <silvio@peroni.it>",
					"Angelo Di Iorio <angelo@diiorio.it>"
				],
				"done": ["Angelo Di Iorio <angelo@diiorio.it>"]
			}
			]
		}
		]
	}
	</script>
	<script id="voti" type=”application/ld+json”>
	[{
		"@context": "easyrash.json",
		"@type": "comment",
		"@id": "#article1",
		"text": "The text of the comment referring to a fragment (i.e., a 'p')",
		"ref": "#prova",
		"author": "mailto:john@smith.com",
		"date": "2016-01-16T11:54:26"
	}]
</script>
</head>
<body>
	<div class="container-fluid">
		<!-- NAV !-->
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<nav class="navbar navbar-inverse">
				  <div class="container-fluid">
					<div class="navbar-header">
					  <a class="navbar-brand" href="#">Rash Project</a>
					</div>
					<div class="collapse navbar-collapse">
					  <ul class="nav navbar-nav navbar-right">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					  </ul>
					</div>
				  </div>
				</nav>
			</div>
		</div>
		<!-- NAV LIKE SLIDES 
		<div class="row">
			<div class="hidden-xs col-sm-2 col-md-2 col-lg-2">
				<img id="logo" src="http://www.fershop.it/media/com_hikashop/upload/00296984.jpg" alt="raschietto" />!
			</div>
			<div class="col-sm-8 col-md-8 col-lg-8"></div>
			<div id="menu" class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
				Menubar (as draft)
			</div>
		</div>
		!-->
		<!-- BODY !-->
		<div class="row">
			<!-- ASIDE !-->
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<div class="dropdown">
					<a href="#" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
					Select Conference<b class="caret"></b></a>
					<ul id="events" class="dropdown-menu">
						<li class="dropdown-header">Events</li>
					</ul>
				</div>
				<div id="articles" class="list-group"></div>
				<div class="list-group">
				  <a href="#" class="list-group-item">Annotation 1</a>
				  <a href="#" class="list-group-item">Annotation 2</a>
				  <a href="#" class="list-group-item">Annotation 3</a>
				</div>
			</div>
			<!-- SECTION !-->
			<div class="col-sm-9 col-md-9 col-lg-9">
				<nav class="navbar">
				  <div class="container-fluid">
					<div class="navbar-header">
					  <a class="navbar-brand" href="#">User Name</a>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
					  <ul class="nav navbar-nav">
						<li class="dropdown">
						  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
						  <ul class="dropdown-menu">
							<li><a href="#" type="button" class="btn" data-toggle="modal" data-target="#createAnnotation">Create Annotation</a></li>
							<li><a href="#" type="button" class="btn" data-toggle="modal" data-target="#reviewArticle">Review Article</a></li>
							<li><a href="#" type="button" class="btn" data-toggle="modal" data-target="#chairArticle">Chair Article</a></li>
						  </ul>
						</li>
						<li><a href="#">Save Changes</a></li>
						<li><a href="#">Filter annotation type</a></li>
						<li><a href="#">Annotator</a></li>
					  </ul>
					</div>
				  </div>
				</nav>
				<!--<iframe id="article" src="prova.html" style="width:100%;height:400px"></iframe>!-->
				<div id="article">Ciao</br>sono <i><b>Emanuele</b> Sinagra</i>
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
						 <textarea class="form-control" style="min-width: 100%" id="textareaID" placeholder="Insert your annotation here."></textarea>
					  </div>
					  <div class="modal-footer">
						<button onclick="storeAnnotation(document.getElementById('textareaID').value)" class="btn btn-default btn-success" data-dismiss="modal">Ok</button>
						<button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
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
							<div class="btn-group" data-toggle="buttons">
							  <label class="btn btn-primary active">
								<input type="radio" name="options" value="1" autocomplete="off" checked> 1
							  </label>
							  <label class="btn btn-primary">
								<input type="radio" name="options" value="2" autocomplete="off"> 2
							  </label>
							  <label class="btn btn-primary">
								<input type="radio" name="options" value="3" autocomplete="off"> 3
							  </label>
							  <label class="btn btn-primary">
								<input type="radio" name="options" value="4" autocomplete="off"> 4
							  </label>
							  <label class="btn btn-primary">
								<input type="radio" name="options" value="5" autocomplete="off"> 5
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
								<input type="radio" name="options" value="1" autocomplete="off" checked> Accept
							  </label>
							  <label class="btn btn-danger">
								<input type="radio" name="options" value="2" autocomplete="off"> Reject
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
		</div>
	</div>
</body>
</html>