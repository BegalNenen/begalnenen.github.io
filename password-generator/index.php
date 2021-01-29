<?php
	if(isset($_POST['generate'])):
		require 'Password.php';
		$data = $_POST;
		//unset($data['generate']);
		$s = $data['s'];
		//unset($data['s']);
		$s = str_replace( ' ', '', $s );
		$special = str_split($s);
		//print_r($s);
		$pass = new Password( $data, $special );
		$pw = $pass->generatePassword();
	else:
		$pw = '  ';
		$pass = FALSE;
	endif;
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Password Generator</title>
		<meta name="description" content="Password Generator">
		<meta name="keywords" content="Password Generator">
		<meta name="author" content="Begal Nenen">
		<link type="text/css" rel="stylesheet" href="bootstrap.min.css">
		<style type="text/css">
			.form-control{float:left;}
		</style>
	</head>
	<body>
	
	<div class="container">
		<div class="page-header" style="margin-top:20px;">
			<h1>Password Generator</h1>
		</div>
		
		<div class="row">
		
			<div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 visible-xs">
				<div class="well">
					<h4>Password Mu</h4>
					<div class="row">
						<pre class="col-xs-12 col-md-12 col-lg-12" 
							style="font-size:1.3em;padding:5px;background:#f9f2f4;color:#dc3e4e;"><?php echo $pw;?></pre>
					</div>
					<h4 class="hidden">Password Hash</h4>
					<div class="row hidden">
						<pre class="col-xs-12 col-md-12 col-lg-12" 
							style="font-size:1.3em;padding:5px;background:#f9f2f4;color:#dc3e4e;"><?php //echo md5($pw)?></pre>
					</div>
					<?php if($pass):
						 if($pass->get_error()):?>
							<div class="alert alert-warning"><h4>Warning!</h4><?php echo $pass->get_error();?></div>
						<?php endif;endif;?>
				</div>
			</div>
		
			<div class="col-xs-12 col-sm-5 col-md-6 col-lg-6">
			<div class="well">
				<form method="POST" action="" class="form-horizontal">
					<div class="form-group">
						<label class="col-lg-4 control-label">Banyak Karakter</label>
						<div class="col-lg-8">
							<input class="form-control input-sm"  type="text" name="length" 
							value="<?php if(isset($_POST['length'])) echo $_POST['length']; else echo 10;?>">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-4 control-label">Karakter Yang Diperbolehkan<small color="green"></small></label>
						<div class="col-lg-8">
							<input class="form-control input-sm"  type="text" name="s" class=""
							value="<?php if(isset($_POST['s'])) echo $_POST['s']; 
							else echo '~ ! @ # $ % ^ & * ( ) - _ + = { } [ ] ; : ?';?>">
						</div>
					</div>

					<div class="col-md-4 col-lg-3 col-lg-offset-3">
						<div class="form-group">
						<?php
							if(isset($_POST['lower_case']))
								$lc = $_POST['lower_case'];
							else $lc = 1;
						?>
						<label class="control-label col-sm-12" style="text-align:center;">Huruf Kecil</label><br>
							<div class="col-sm-12">
								<input type="range" name="lower_case" class="form-control input-sm" min="0" max="1" step="1" 
								placeholder="ON OFF" value="<?php echo $lc;?>">
								<span class="pull-left">OFF</span>  <span class="pull-right">ON</span>
							</div>
						</div>
					</div>
					
					<div class="col-md-4 col-lg-3">
						<div class="form-group">
						<?php if(isset($_POST['upper_case'])) $uc = $_POST['upper_case']; else $uc = 1;?>
						<label class="control-label col-sm-12" style="text-align:center;">Huruf Besar</label><br>
							<div class="col-sm-12">
								<input type="range" name="upper_case" class="form-control input-sm" min="0" max="1" step="1" 
								placeholder="ON OFF" value="<?php echo $uc;?>">
								<span class="pull-left">OFF</span>  <span class="pull-right">ON</span>
							</div>
						</div>
					</div>
					
					<div class="col-md-4 col-lg-3">
						<div class="form-group">
							<?php if(isset($_POST['digits'])) $dg = $_POST['digits']; else $dg = 1;?>
							<label class="control-label col-sm-12" style="text-align:center;">Digits</label>
							<div class="col-sm-12">
								<input type="range" name="digits" class="form-control input-sm" min="0" max="2" step="1" 
								placeholder="ON OFF" value="<?php echo $dg;?>">
								<span class="col-xs-4 col-sm-4" style="padding:0;">OFF</span>
								<span class="col-xs-4 col-sm-4" style="padding:0; text-align:center;">ON</span>
								<span class="col-xs-4 col-sm-4" style="padding:0;text-align:right;">HEX</span>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-4 col-lg-offset-3">
						<div class="form-group">
							<?php if(isset($_POST['special'])) $sc = $_POST['special']; else $sc = 0;?>
							<label class="control-label col-sm-12" style="text-align:left;">Special Characters</label>
							<div class="col-md-10 col-lg-9">
								<input type="range" name="special" class="form-control input-sm" min="0" max="1" step="1" 
								placeholder="ON OFF" value="<?php echo $sc;?>">
								<span class="pull-left">OFF</span>  <span class="pull-right">ON</span>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-lg-4">
						<div class="form-group">
							<?php if(isset($_POST['unique'])) $uq = $_POST['unique']; else $uq = 0;?>
							<label class="control-label col-sm-12" style="text-align:left;">Unique Characters</label>
							<div class="col-md-10 col-lg-9">
								<input type="range" name="unique" class="form-control input-sm" min="0" max="1" step="1" 
								placeholder="ON OFF" value="<?php echo $uq;?>">
								<span class="pull-left">OFF</span>  <span class="pull-right">ON</span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-lg-offset-4 col-lg-8">
							<button type="submit" name="generate" value="1" class="btn btn-primary pull-right" 
							style="margin-right:10px;">Submit</button>
							<a href="" class="btn btn-default pull-right" style="margin-right:10px;">Reset</a>
						</div>
					</div>
				</form>
			</div><!-- end of well -->
			</div><!-- end of col-xs-12 col-md-6 col-lg-6 -->

			<div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 hidden-xs">
				<div class="well">
					<h4>Password Mu</h4>
					<div class="row">
						<pre class="col-xs-12 col-md-12 col-lg-12" 
							style="font-size:1.3em;padding:5px;background:#f9f2f4;color:#dc3e4e;"><?php echo $pw;?></pre>
					</div>
					<h4 class="hidden">Password Hash</h4>
					<div class="row hidden">
						<pre class="col-xs-12 col-md-12 col-lg-12" 
							style="font-size:1.3em;padding:5px;background:#f9f2f4;color:#dc3e4e;"><?php //echo md5($pw)?></pre>
					</div>
					<?php if($pass):
						 if($pass->get_error()):?>
							<div class="alert alert-warning"><h4>Warning!</h4><?php echo $pass->get_error();?></div>
						<?php endif;endif;?>
				</div>
				<div class="well">
					Terima kasih sudah menggunakan Password Generator :)<br><br>
					<a class="btn btn-success btn-lg" href="https://www.begalnenen.github.io" target="_blank">Visit Project</a><br><br>
					<small>
					&copy; 2021, 
					Updated by Nan</small><br>
					<small>Version 1.1</small>
				</div>
			</div><!-- end of col-xs-12 col-md-6 col-lg-6 -->
		</div><!-- end of row -->
		
		
		</div>
	</div><!-- end of container -->
</body>
</html>
<div class="footer">
	
				Developed ❤ <a href="https://facebook.com/nan.phtml"><b>Nan</b></a>
			</div>
