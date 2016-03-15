    <style type='text/css'>
#loading {
   width: 100%;
   height: 100%;
   top: 0px;
   left: 0px;
   position: fixed;
   display: block;
   opacity: 0.9;
   background-color: #fff;
   z-index: 99;
   text-align: center;
}
#loading-image {
  padding-top: 100px;
  width: 20%;
   margin: 0 auto; 
   z-index:100;
}

         #divProgress{
            border:2px solid #ddd; 
            padding:10px; 
            width:300px; 
            height:265px; 
            margin-top: 10px;
            overflow:auto; 
            background:#f5f5f5;
        }

        #progress_wrapper{
            border:2px solid #ddd;
            width:321px; 
            height:20px; 
            overflow:auto; 
            background:#f5f5f5;
            margin-top: 10px;
        }

        #progressor{
            background:#07c; 
            width:0%; 
            height:100%;
            -webkit-transition: all 1s linear;
            -moz-transition: all 1s linear;
            -o-transition: all 1s linear;
            transition: all 1s linear; 

        }

        .demo_container{
            width: 680px;
            margin:0 auto;
            padding: 30px;
            background: #FFF;
            margin-top: 50px;
        }

        .my-btn, .my-btn2{
            width: 297px;
            margin-top: 22px;
            float: none;
            display: block;
        }

        h1{
            font-size: 22px;
            margin-bottom: 20px;
        }

        .float_left{
            float: left;
        }

        .float_right{
            float: right;
        }

        .demo_container::after {
            content: "";
            clear: both;
            display: block;
        }

        .ghost-btn.active {
            border: 2px solid #D23725;
            color: #D23725;
        }

        .ghost-btn {
            display: inline-block;
            text-decoration: none;
            border: 2px solid #3b8dbd;
            line-height: 15px;
            color: #3b8dbd;
            -webkit-border-radius: 3px;
            -webkit-background-clip: padding-box;
            -moz-border-radius: 3px;
            -moz-background-clip: padding;
            border-radius: 3px;
            background-clip: padding-box;
            font-size: 15px;
            padding: .6em 1.5em;
            -webkit-transition: all 0.2s ease-out;
            -moz-transition: all 0.2s ease-out;
            -o-transition: all 0.2s ease-out;
            transition: all 0.2s ease-out;
            background: #ffffff;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            cursor: pointer;
            zoom: 1;
            -webkit-backface-visibility: hidden;
            position: relative;
            margin-right: 10px;
        }
        .ghost-btn:hover {
            -webkit-transition: 0.2s ease;
            -moz-transition: 0.2s ease;
            -o-transition: 0.2s ease;
            transition: 0.2s ease;
            background-color: #3b8dbd;
            color: #ffffff;
        }
        .ghost-btn:focus {
            outline: none;
        }

        .ghost-btn.active {
            border: 2px solid #D23725;
            color: #D23725;
        }

        .ghost-btn.active:hover {
             border: 2px solid #D23725;
             background: #FFF;
        }

        .method_wrappers{
            margin-bottom: 20px;
        }
    </style>
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Create New Annual Report') ?></div>
				</div>
				<div class="portlet-body">
				  
    <?= $this->Form->create($annualReport, ['type' => 'file', "onsubmit"=>"ajax_stream(this); return false;" ]) ?>

        <?php
            //echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('name', ['label'=>'Annual Report Name']);
            echo $this->Form->input('company_name');
			
            echo $this->Form->input('report_year',['class'=>'datepicker-default form-control datepickermonth', 'label'=>'Annual report Year']);
            echo $this->Form->input('shareholder_file_path', ['type' => 'file', 'label'=>'Shareholder List File(xls, xlsx)']);
            echo $this->Form->input('report_pdf_file_path', ['type' => 'file', 'label'=>'Annual Report Pdf']);

            echo $this->Form->input('content', ['label'=>'Description']);
        ?>
		<div id="loading" style="display:none">
			<div id="loading-image">
				<h3>Progress</h3>
				<div id='progress_wrapper'>
					<div id="progressor"></div>
				</div>

				<h3>Status</h3>
				<div id="divProgress"></div>
			</div>	
		</div>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success btnsoft']) ?>
    <?= $this->Form->end() ?>

</div>
			</div>
		</div>
	</div>
	
	<script type="application/javascript">
		function ajax_stream(oFormElement){
           $('#loading').show();
           if (!window.XMLHttpRequest){
                alert("Your browser does not support the native XMLHttpRequest object.");
                return false;
            }
            try{
                var xhr = new XMLHttpRequest();  
                xhr.previous_text = '';
                xhr.onerror = function() { alert("[XHR] Fatal Error."); };
                xhr.onreadystatechange = function() {
                    try{
                        if (xhr.readyState == 4){
                            window.location.href = "<?php echo $this->Url->build('/annual-reports', true);?>";
							return false;
                        } 
                        else if (xhr.readyState > 2){
                            var new_response = xhr.responseText.substring(xhr.previous_text.length);
                            var result = JSON.parse( new_response );
                            
                            document.getElementById("divProgress").innerHTML += result.message + '<br />';
                            document.getElementById('progressor').style.width = result.progress + "%";
                            
                            xhr.previous_text = xhr.responseText;
							 return false;
                        }  
                    }
                    catch (e){
                        return false;
                    }                     
                };
				xhr.open (oFormElement.method, oFormElement.action, true);
	            //xhr.setRequestHeader("Content-Type","multipart/form-data");
				xhr.send (new FormData (oFormElement));		
				return false;
            }
            catch (e){
				return false;
            }
        }
	</script>
</div>

