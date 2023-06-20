<!-- メッセージ -->
<?php if(isset($msg)) { ?>
<div class="alert alert-primary alert-dismissible fade show" role="alert">
	<?php echo $msg ?>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<?php } ?>

<!-- 横書き台本 -->
<div id = "">
	<!-- 見出し -->
	<div class = "row"> 
		<h2 class = "blue">台本概要</h2>
	</div>

	<!-- 説明描画用テーブル -->
	<table id="desc_edit" class = "col-12">
		<tr>
			<th class = "h_txt" style="width: 20%">タイトル</th>
			<td class = "title">
					<?php echo $title; ?>		
					<div class = "credit_copy_button_area">					
					<!--<button type="button" id = "credit_copy_button" class="btn btn-secondary btn-sm" data-toggle = "modal" data-target = "#credit_copy_form"  data-placement="bottom" title="『<?php echo $title; ?>』作者：<?php echo $author_name	; ?>様">台本名/作者名をコピー</button>-->
					<a href="<?php echo $tweet_url ?>" target = "_blank">
						<button type="button" id = "credit_copy_button" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><i class="bi bi-twitter"></i>&nbsp;つぶやく</button>
					</a>
				</div>
				</div>	
			</td>
		</tr>
		<tr>
			<th class = "h_txt">作者名</th>
			<td>
				<?php echo $author_name; ?>	
				<?php 
				if ( !empty($author_twitter_id)) {
					echo '　(<a href = "https://twitter.com/' . str_replace("@", "", $author_twitter_id) . '" target="_blank">@' . str_replace("@", "", $author_twitter_id) . '</a>)';
				}
				?>				
			</td>					
		</tr>				
		<tr>
			<th class = "h_txt">ジャンル</th>
			<td>					
				<?php echo $genre; ?>					
			</td>					
		</tr>
		<tr>
			<th class = "h_txt">人数</th>
			<td>
				<?php echo $chara_count; ?>人（<?php echo $chara_sex_summary ?>）	
			</td>					
		</tr>
		<tr>
			<th class = "h_txt">時間</th>
			<td>
				<?php echo $minutes; ?>	
				分					
			</td>					
		</tr>
		<tr>
			<th class = "h_txt">台本使用規定</th>
			<td>
				<?php echo $reusable; ?>								
			</td>
		</tr>						
		<tr>
			<th class = "h_txt">説明</th>
			<td class = "description"><?php echo nl2br($description); ?></td>					
		</tr>
	</table>

	<!-- 編集ボタン -->
	<div id = "edit_button_area" class = "text-right">
		<input type = "button" value = "編集" data-toggle = "modal" data-target = "#input_password_form" />
	</div>

	<!-- モーダルウィンドウ（クレジット情報） -->
	<div class = "modal fade" id = "credit_copy_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class = "modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">台本/作者名のコピー</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action = "<?php echo Uri::create('script/edit_form/') . $id ?>" method = "POST">
					<div class = "modal-body" id = "input_password_form_body">
						<p><small>以下の情報がクリップボードにコピーされました。<br />台本を使用する場合等に貼り付けて下さい。</small></p><br />
						<p>
							『<?php echo $title; ?>』作者：<?php echo $author_name	; ?>様<br />
							<?php 
								$currentURL = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
								//echo $currentURL;
							?>
						</p>									
					</div>				
					<div class="modal-footer text-center" id = "input_password_form_footer">
						<button type="button" class="btn btn-primary" id = "exec_credit_copy_button" data-dismiss="modal" title = "『<?php echo $title; ?>』作者：<?php echo $author_name	; ?>様">　OK　</button>
					</div>
					</div>
				</form>
			</div>
		</div>

	<!-- モーダルウィンドウ（編集） -->
	<div class = "modal fade" id = "input_password_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class = "modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">編集用パスワードの入力</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action = "<?php echo Uri::create('script/edit_form/') . $id ?>" method = "POST">
				<div class = "modal-body" id = "input_password_form_body">
					<p>台本投稿時に設定したパスワードを入力してください。</p>						
					<input type = "password" name = "edit_password" id = "edit_password_tb" size = "20" value = "<?php echo $cookie_edit_password ?>" />
				</div>
				<div class="modal-footer text-center" id = "input_password_form_footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" id = "dummy_submit_edit_password_button">　OK　</button>
					<input type = "submit" class= "d-none" id = "hidden_submit_edit_password_button" />

					<input type = "hidden" value = "<?php echo $edit_password ?>" id = "correct_edit_password" />
					<input type = "hidden" name = "id" value = "<?php echo $id ?>" />
				</div>
				</div>
			</form>
		</div>
	</div>

	<!-- 見出し -->
	<div class = "row"> 
		<h2 class = "blue">キャラ説明　　<small></small></h2>
	</div>

	<!-- キャラ説明描画用テーブル -->
	<table id = "chara" class = "col-12 list">
		<tr>
			<!--<th class = "h_txt"></th>-->
			<th class = "h_txt">名前</th>
			<th class = "h_txt">性別</th>					
			<!-- 台詞数 -->			
			<th class = "h_txt">台詞数</th>	

			<th class = "h_txt">説明</th>	
		</tr>				
		<!-- ループ -->
		<?php for ($i = 0; $i < $chara_count; $i++) { 
			$c = $cs[$i];
		?>
		<tr>
			<!--<td class = "check_mark">

			</td>-->
			<td class = "name">
				<span class = "<?php echo $c['color_cord'] ?>" style = "background:#<?php echo $c['color_cord'] ?>"><?php echo $c['name'] ?></span>
				<input type = "hidden" name = "chara_name_<?php echo $i ?>" value = "<?php echo $c['name'] ?>">
			</td>

			<td class = "sex">
					<?php echo $c['sex']?>
					<?php if ($c['sex'] == "男") { 
						echo Asset::img('man.png', array('width'=>'8')); 
					} elseif ($c['sex'] == "女") { 
						echo Asset::img('woman.png', array('width'=>'8')); 
					} ?>
			</td>			
			<!-- 台詞数 -->
			<td class = "voice_count">
				<?php if ($c['voice_count'] == 0) { 
							echo "-"; 
						} else { 
							echo $c['voice_count']; 
						} ?>
			</td>			
			<td class = "description text-left">
				<?php echo $c['description'] ?>
			</td>		
		</tr>
		<?php } ?>
	</table>		

	<!-- 見出し -->
	<div class = "row"> 
		<h2 class = "blue">台本本編</h2>
	</div>

	<!-- 縦書き台本 -->
	<div id = "vertical_modal_container" class = "d-none">
		<div id = "vertical_modal_body" class = "">
			<div id = "vertical_button_area" class = "clearfix">	
				<div class = "float-right">		
					<input type = "button" id = "close_vertical_button" class = "btn btn-outline-secondary" value = "× 縦書き画面を閉じる"></input>		
				</div>
			</div>	
			<div id = "vertical_script_area" class = "horizontal-scroll">
				<?php echo $script_body; ?>		
			</div>
		</div>	
	</div>

	<!-- 横書き台本 -->
	<div id = "horizon">	
		<!-- 縦書きに切り替えボタン -->
		<div id = "show_by_vertical_button_area" class = "clearfix">
			<div class = "float-right">		
				<input type = "button" id = "show_by_vertical_button" class = "btn btn-outline-secondary" value = "縦書きで表示"></input>		
			</div>
		</div>	

		<!-- セリフプレーンテキスト描画欄（非表示）-->
		<div id = "script_write_area" class = "d-none">
			<?php echo $script_body; ?>
		</div>
		<!-- セリフ描画欄（テーブル）-->
		<div id = "script_show_area">
		</div>		
	</div>
</div>
