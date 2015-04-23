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
    <script type="text/javascript">
        $(document).ready(function(){
            var rows_per_page=20;
            var tag;
            var pageCount=1;
            $("button#searchBtn").click(function(){
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
					//alert(data);
					if (data=="")
						alert("no result");
					$('#song-list').html(data);
				}
			});
            });
        });
    </script>

    <div id="search" class="container page-header">
        <form class="form-inline" method="" action="javascript:void(0);">
            <div class="form-group">
                <label for="inputTag">Tag</label>
                <input type="text" class="form-control" id="inputTag" placeholder="idealistic">
            </div>
            <button class="btn btn-primary" id="searchBtn">Search</button>
        </form>
    </div>
    <div id="songs" class="container">
        <container class="container">
            <ul class="list-group" id="song-list">
				       <li class='list-group-item'><h4 class='list-group-item-heading'>sasdsad</h4><p class='list-group-item-text'><span class='badge'>asdasd</span></p></li>
					   
					   
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