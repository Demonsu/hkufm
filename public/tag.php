<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>


	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./dist/js/bootstrap.js"></script>
	<link rel="stylesheet" href="./dist/css/bootstrap1.min.css" />
	<link rel="stylesheet" href="./css/tag.css" />
    <script type="text/javascript">
        $(document).ready(function(){
            var rows_per_page=20;
            var tag;
            var pageCount=1;
            $("button#searchBtn").click(function(){
				document.getElementById('loading-bar').style.display='block';
                /**
                 * As soon as a tag is searched, the page shows the first page of songs containing the tag
                 */
                var tag=$("#inputTag").val();
				//alert(tag);
				if (tag.length<3)
					alert("you are going to wait for a century");
               	$.ajax({
				type:'POST',
				url:'./handle/tag.php',
				data:{
					operation:'GETTAGBYTAG',
					tag:tag
				},
				//dataType:'json',
				success:function(data){
				document.getElementById('loading-bar').style.display='none';
					//alert(data);
					if (data=="")
						alert("no result");
					$('#song-list').html(data);
				}
			});
            });
			$("#searchSongBtn").click(function(){
				document.getElementById('loading-bar').style.display='block';
                /**
                 * As soon as a tag is searched, the page shows the first page of songs containing the tag
                 */
                var tag=$("#inputSong").val();
				alert(tag);
				if (tag.length<3)
					alert("you are going to wait for a century");
               	$.ajax({
				type:'POST',
				url:'./handle/tag.php',
				data:{
					operation:'GETTAGBYSONGID',
					song:tag
				},
				//dataType:'json',
				success:function(data){
				document.getElementById('loading-bar').style.display='none';
					//alert(data);
					if (data=="")
						alert("no result");
					$('#song-list').html(data);
				}
			});
            });
        });
    </script>
<div id="loading-bar">
	<div class="loading-cover"></div>
	<div class="loading-pic"><img src="./img/loading.gif"/></div>
</div>
    <div id="search" class="container page-header">
        <form class="form-inline" method="" action="javascript:void(0);">
            <div class="form-group">
                <label for="inputTag">Tags</label>
                <input type="text" class="form-control" id="inputTag" placeholder="idealistic">
            </div>
            <button class="btn btn-primary" id="searchBtn">Search</button>
        </form>
    </div>
	<div id="searchsong" class="container page-header">
        <form class="form-inline" method="" action="javascript:void(0);">
            <div class="form-group">
                <label for="inputTag">Song</label>
                <input type="text" class="form-control" id="inputSong" placeholder="idealistic">
            </div>
            <button class="btn btn-primary" id="searchSongBtn">Search</button>
        </form>
    </div>
    <div id="songs" class="container">
        <container class="container">
            <ul class="list-group" id="song-list">
				   
					   
					   
            </ul>
            <nav>
                <ul class="pagination">
                    <li class="disabled">
                        <a href="javascript:void(0);" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="active"><a href="javascript:void(0);">1</a></li>
                    <li class="disabled">
                        <a href="javascript:void(0);" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </container>

    </div>
</body>
</html>