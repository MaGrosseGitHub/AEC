<?php echo HTML::CSS("View/Contact/fonts/font-awesome-4.2.0/css/font-awesome.min"); ?>
<?php echo HTML::CSS("View/Contact/contact"); ?>
<div class="row">
	<div class="col-md-12 contact-container">
		<!-- <form id = "form" action="<?php echo Router::url('contact/index/'); ?>" method="post" enctype="multipart/form-data">
			<?php 

		    echo $this->Form->input('object','Objet');
		    echo $this->Form->input('name','Nom Prénom');
		    echo $this->Form->input('email','email', array('type' =>'email'));
		    echo $this->Form->input('content','Contenu',array('type'=>'textarea','rows'=>5));

		    $this->Form->JSCheck("form");
		   ?>

		  <br>
			<div class="actions">
				<input type="submit" class="btn primary" value="Envoyer">
			</div>
		</form> -->
		<h2><?php echo HTML::getImg("css/View/Contact/img/letter-icon.svg", false, null, null, false, true); ?></h2>
		<form action="<?php echo Router::url('contact/index/'); ?>" method="post">

			<section class="content bgcolor-1">					
				<span class="inputContact input--fumi">
					<input class="input__field input__field--fumi" type="text" id="inputobject" name="object" required/>
					<label class="input__label input__label--fumi" for="inputobject">
						<i class="fa fa-fw fa-archive icon icon--fumi"></i>
						<span class="input__label-content input__label-content--fumi">Objet</span>
					</label>
				</span>
				<span class="inputContact input--fumi">
					<input class="input__field input__field--fumi" type="text" id="inputname" name="name" required/>
					<label class="input__label input__label--fumi" for="inputname">
						<i class="fa fa-fw fa-user icon icon--fumi"></i>
						<span class="input__label-content input__label-content--fumi">Nom Prénom</span>
					</label>
				</span>
				<span class="inputContact input--fumi">
					<input class="input__field input__field--fumi" type="email" id="inputemail" name="email" required/>
					<label class="input__label input__label--fumi" for="inputemail">
						<i class="fa fa-fw fa-envelope icon icon--fumi"></i>
						<span class="input__label-content input__label-content--fumi">Email</span>
					</label>
				</span>
				<span class="inputContact input--fumi">
					<textarea class="input__field input__field--fumi" name="content" id="inputcontent" required ></textarea>
					<label class="input__label input__label--fumi" for="inputcontent">
						<i class="fa fa-fw fa-pencil-square-o icon icon--fumi"></i>
						<span class="input__label-content input__label-content--fumi textareaC">Message</span>
					</label>
				</span>
				<span class="cd-form floating-labels" >
					<!-- <br>
					<fieldset>
						<div class="icon">
							<label class="cd-label" for="cd-textarea">Project description</label>
			      			<textarea class="message" name="inputcontent" id="inputcontent" required></textarea>
						</div>
					</fieldset> -->

					<div class = "nl-submit-wrap">
				      	<button class="nl-submit" type="submit">Envoyer</button>
				    </div>
				</span>

				<?php echo $this->Form->input('adresse','hidden'); ?>
			</section>
		</form>
	</div>
</div>

<script>
	jQuery(document).ready(function($){
		if( $('.floating-labels').length > 0 ) {
			floatLabels();
		}

		function floatLabels() {
			var inputFields = $('.floating-labels .cd-label').next();
			inputFields.each(function(){
				var singleInput = $(this);
				//check if user is filling one of the form fields 
				checkVal(singleInput);
				singleInput.on('change keyup', function(){
					checkVal(singleInput);	
				});
			});
		}

		function checkVal(inputField) {
			( inputField.val() == '' ) ? inputField.prev('.cd-label').removeClass('float') : inputField.prev('.cd-label').addClass('float');
		}
	});
	(function() {
		// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
		if (!String.prototype.trim) {
			(function() {
				// Make sure we trim BOM and NBSP
				var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
				String.prototype.trim = function() {
					return this.replace(rtrim, '');
				};
			})();
		}

		[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
			// in case the input is already filled..
			if( inputEl.value.trim() !== '' ) {
				classie.add( inputEl.parentNode, 'input--filled' );
			}

			// events:
			inputEl.addEventListener( 'focus', onInputFocus );
			inputEl.addEventListener( 'blur', onInputBlur );
		} );

		function onInputFocus( ev ) {
			classie.add( ev.target.parentNode, 'input--filled' );
		}

		function onInputBlur( ev ) {
			if( ev.target.value.trim() === '' ) {
				classie.remove( ev.target.parentNode, 'input--filled' );
			}
		}
	})();
</script>