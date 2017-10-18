<style>
#import input[type=file]
{
	position: absolute;
		top: 0;
		width: 100%;
		height: 100%;
		opacity: 0;
		cursor: pointer;
}
#import .drop
{
	text-align: center;font-size: 22px;padding: 54px;background: #ccc;color: #837E7E;cursor: pointer;
}
#import #result
{
	margin-top: 28px;
	display: block;
}
#result p {
	padding: 5px;
	color: red;	
}
#result p.total
{
	color:#444;
}
</style>
<div class="records index large-9 medium-8 columns content">
    <h3><?= __('Import Csv') ?></h3>
    <form id="import" action="<?php echo HTTP_ROOT ?>/import" method="post" enctype="multipart/form-data">
    <div style="position:relative">
		<div class="drop" style="">
			Choose a file or Drop your file here.
		</div>
		<input type="file" name="file" style="">
    </div>
    </form>
    <pre id="result">
		<?php echo $this->request->session()->read('errors'); $this->request->session()->delete('errors');?>
    </</div>
</div>
