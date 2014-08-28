<script>
    $(document).ready(function(){
        $('.<?php echo $class ?>').chosen({
		placeholder_text_single:"find object",
		width: "250px"
		});
        $(".<?php echo $class ?>-deselect").chosen({
            allow_single_deselect:true
			
        });
    });
</script>