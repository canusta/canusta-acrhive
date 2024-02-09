<?php


global $commandResult;

$commandResult.='


<div class="pageContent noPadding pageGallery">


<div id="my-video"></div>
<script type="text/javascript">
    jwplayer("my-video").setup({
        file: "'.getScriptUrl().'movies/egeb.mp4",
        width: "840",
        height: "450"
    });
</script>


</div>

';



	
?>