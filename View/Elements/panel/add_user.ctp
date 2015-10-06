<!-- Add new user form -->
<div id="myModalAddUser" class="reveal-modal tiny" data-reveal>
  <!-- <h2>Awesome. I have it.</h2>
  <p class="lead">Your couch.  It is mine.</p>
  <p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p> -->

  	<?php echo $this->Form->create('User', array(
   		'url' => array(
   			'controller' => 'users',
   			'action' => 'add')
	)); ?>

	<div class="row">
		<div class="large-12 columns">
			<?= $this->Form->input('name', array('label' => __('Name'), 'required' => true)) ?>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<?= $this->Form->input('username', array('label' => __('Username'))) ?>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<?= $this->Form->input('email', array('type' => 'email', 'required' => true)) ?>
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<?= $this->Form->input('password', array('required' => true, 'label' => __('Password'))) ?>
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<?= $this->Form->input('website', array('label' => __('Website'))) ?>
		</div>
		<div class="large-6 columns">
		 	<?= $this->Form->input('blog', array('label' => __('Blog'))) ?>
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<?= $this->Form->input('facebook', array('label' => __('Facebook'))) ?>
		</div>
		<div class="large-6 columns">
		 	<?= $this->Form->input('twitter', array('label' => __('Twitter'))) ?>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
		  <label><?= __('Date of Establishment') ?>
		  	<?= 
		  		$this->Form->input('birthdate', array('type' => 'date', 'required' => true, 
					'style' => 'width: 32.7%',
					'label' => '',
					'separator' => ' ',
					'dateFormat' => 'DMY',
					'minYear' => date('Y') - 100,
					'maxYear' => date('Y'),
		        ));
			?>
		  </label>
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<?= $this->Form->input('country' , array( 'options' => array(
				null =>    __('Please select a country'),
				'Afganistan' 			=>  	__('Afganistan', true), 
	            'Albania' 				=>  	__('Albania', true), 
	            'Algeria' 				=>  	__('Algeria', true), 
	            'American Samoa' 		=>		__('American Samoa', true), 
	            'Andorra' 				=> 		__('Andorra', true),  
	            'Angola'				=> 		__('Angola', true), 
	            'Anguilla' 				=> 		__('Anguilla', true), 
	            'Antarctica' 			=> 		__('Antarctica', true), 
	            'Antigua and Barbuda' 	=> 		__('Antigua and Barbuda', true),  
	            'Argentina' 			=> 		__('Argentina', true),  
	            'Armenia' 				=> 		__('Armenia', true),
	            'Aruba' 				=> 		__('Aruba', true),  
	            'Australia' 			=> 		__('Australia', true),  
	            'Austria' 				=> 		__('Austria', true),  
	            'Azerbaijan' 			=> 		__('Azerbaijan', true), 
	            'Bahamas' 				=> 		__('Bahamas', true),  
	            'Bahrain' 				=> 		__('Bahrain', true),  
	            'Bangladesh' 			=> 		__('Bangladesh', true), 
	            'Barbados' 				=> 		__('Barbados', true), 
	            'Belarus' 				=> 		__('Belarus', true),  
	            'Belgium' 				=> 		__('Belgium', true),  
	            'Belize' 				=> 		__('Belize', true), 
	            'Benin' 				=> 		__('Benin', true),  
	            'Bermuda' 				=> 		__('Bermuda', true),  
	            'Bhutan' 				=> 		__('Bhutan', true), 
	            'Bolivia' 				=> 		__('Bolivia', true),  
	            'Bosnia and Herzegowina'=> 		__('Bosnia and Herzegowina', true), 
	            'Botswana' 				=> 		__('Botswana', true), 
	            'Bouvet Island' 		=>		__('Bouvet Island', true),  
	            'Brazil' 				=> 		__('Brazil', true), 
	            // 'IO' => __('British Indian Ocean Territory', true), 
	            'Brunei Darussalam' 	=> 		__('Brunei Darussalam', true),  
	            'Bulgaria' 				=> 		__('Bulgaria', true), 
	            'Burkina Faso' 			=> 		__('Burkina Faso', true), 
	            'Burundi' 				=> 		__('Burundi', true),  
	            'Cambodia' 				=> 		__('Cambodia', true), 
	            'Cameroon' 				=> 		__('Cameroon', true), 
	            'Canada' 				=> 		__('Canada', true), 
	            'Cape Verde'			=> 		__('Cape Verde', true), 
	            'Cayman Islands' 		=> 		__('Cayman Islands', true), 
	            'Central African Republic' => 	__('Central African Republic', true), 
	            'Chad' 					=> 		__('Chad', true), 
	            'Chile' 				=> 		__('Chile', true),  
	            'China' 				=> 		__('China', true), 
	            'Christmas Island' => __('Christmas Island', true),     
	            'Cocos (Keeling) Islands' => __('Cocos (Keeling) Islands', true),  
	            'Colombia' => __('Colombia', true), 
	            'Comoros' => __('Comoros', true),  
	            'Congo' => __('Congo', true),  
	            // 'Congo, the Democratic Republic of the' => __('Congo, the Democratic Republic of the', true),  
	            'Cook Islands' => __('Cook Islands', true), 
	            'Costa Rica' => __('Costa Rica', true), 
	            'Cote d\'Ivoire' => __('Cote d\'Ivoire', true),  
	            'Croatia' => __('Croatia (Hrvatska)', true), 
	            'Cuba' => __('Cuba', true), 
	            'Cyprus' => __('Cyprus', true), 
	            'Czech Republic' => __('Czech Republic', true), 
	            'Denmark' => __('Denmark', true),  
	            'Djibouti' => __('Djibouti', true), 
	            'Dominica' => __('Dominica', true), 
	            'Dominican Republic' => __('Dominican Republic', true), 
	            'East Timor' => __('East Timor', true), 
	            'Ecuador' => __('Ecuador', true),  
	            'Egypt' => __('Egypt', true),  
	            'El Salvador' => __('El Salvador', true),  
	            'Equatorial Guinea' => __('Equatorial Guinea', true),  
	            'Eritrea' => __('Eritrea', true),  
	            'Estonia' => __('Estonia', true),  
	            'Ethiopia' => __('Ethiopia', true), 
	            'Falkland Islands' => __('Falkland Islands (Malvinas)', true),  
	            'Faroe Islands' => __('Faroe Islands', true),  
	            'Fiji' => __('Fiji', true), 
	            'Finland' => __('Finland', true), 
	            'France' => __('France', true), 
	            // 'FX' => __('France, Metropolitan', true), 
	            'French Guiana' => __('French Guiana', true),  
	            'French Polynesia' => __('French Polynesia', true), 
	            'French Southern Territories' => __('French Southern Territories', true),  
	            'Gabon' => __('Gabon', true),  
	            'Gambia' => __('Gambia', true), 
	            'Georgia' => __('Georgia', true),  
	            'Germany' => __('Germany', true),  
	            'Ghana' => __('Ghana', true),  
	            'Gibraltar' => __('Gibraltar', true),  
	            'Greece' => __('Greece', true), 
	            'Greenland' => __('Greenland', true),  
	            'Grenada' => __('Grenada', true),  
	            'Guadeloupe' => __('Guadeloupe', true), 
	            'Guam' => __('Guam', true), 
	            'Guatemala' => __('Guatemala', true),  
	            'Guinea' => __('Guinea', true), 
	            'Guinea-Bissau' => __('Guinea-Bissau', true),  
	            'Guyana' => __('Guyana', true), 
	            'Haiti' => __('Haiti', true),  
	            // 'HM' => __('Heard and Mc Donald Islands', true),  
	            // 'VA' => __('Holy See (Vatican City State)', true),  
	            'Honduras' => __('Honduras', true), 
	            'Hong Kong' => __('Hong Kong', true),  
	            'Hungary' => __('Hungary', true),  
	            'Iceland' => __('Iceland', true),  
	            'India' => __('India', true),  
	            'Indonesia' => __('Indonesia', true),  
	            'Iran' => __('Iran (Islamic Republic of)', true), 
	            'Iraq' => __('Iraq', true), 
	            'Ireland' => __('Ireland', true),  
	            'Israel' => __('Israel', true), 
	            'Italy' => __('Italy', true),  
	            'Jamaica' => __('Jamaica', true),  
	            'Japan' => __('Japan', true), 
	            'Jordan' => __('Jordan', true), 
	            'Kazakhstan' => __('Kazakhstan', true), 
	            'Kenya' => __('Kenya', true),  
	            'Kiribati' => __('Kiribati', true), 
	            'Korea, Democratic People\'s Republic of' => __('Korea, Democratic People\'s Republic of', true), 
	            'Korea, Republic of' => __('Korea, Republic of', true), 
	            'Kuwait' => __('Kuwait', true), 
	            'Kyrgyzstan' => __('Kyrgyzstan', true), 
	            'Lao People\'s Democratic Republic' => __('Lao People\'s Democratic Republic', true), 
	            'Latvia' => __('Latvia', true), 
	            'Lebanon' => __('Lebanon', true), 
	            'Lesotho' => __('Lesotho', true),  
	            'Liberia' => __('Liberia', true),  
	            'Libyan Arab Jamahiriya' => __('Libyan Arab Jamahiriya', true), 
	            'Liechtenstein' => __('Liechtenstein', true),  
	            'Lithuania' => __('Lithuania', true), 
	            'Luxembourg' => __('Luxembourg', true), 
	            'Macau' => __('Macau', true),  
	            'Macedonia' => __('Macedonia, The Former Yugoslav Republic of', true), 
	            'Madagascar' => __('Madagascar', true), 
	            'Malawi' => __('Malawi', true), 
	            'Malaysia' => __('Malaysia', true), 
	            'Maldives' => __('Maldives', true), 
	            'Mali' => __('Mali', true), 
	            'Malta' => __('Malta', true), 
	            'Marshall Islands' => __('Marshall Islands', true), 
	            'Martinique' => __('Martinique', true), 
	            'Mauritania' => __('Mauritania', true), 
	            'Mauritius' => __('Mauritius', true), 
	            'Mayotte' => __('Mayotte', true),  
	            'Mexico' => __('Mexico', true), 
	            'Micronesia, Federated States of' => __('Micronesia, Federated States of', true), 
	            'Moldova, Republic of' => __('Moldova, Republic of', true), 
	            'Monaco' => __('Monaco', true), 
	            'Mongolia' => __('Mongolia', true), 
	            'Montserrat' => __('Montserrat', true), 
	            'Morocco' => __('Morocco', true), 
	            'Mozambique' => __('Mozambique', true), 
	            'Myanmar' => __('Myanmar', true), 
	            'Namibia' => __('Namibia', true), 
	            'Nauru' => __('Nauru', true),  
	            'Nepal' => __('Nepal', true),  
	            'Netherlands' => __('Netherlands', true), 
	            'Netherlands Antilles' => __('Netherlands Antilles', true), 
	            'New Caledonia' => __('New Caledonia', true), 
	            'New Zealand' => __('New Zealand', true),  
	            'Nicaragua' => __('Nicaragua', true),  
	            'Niger' => __('Niger', true),  
	            'Nigeria' => __('Nigeria', true),  
	            'Niue' => __('Niue', true), 
	            'Norfolk Island' => __('Norfolk Island', true), 
	            'Northern Mariana Islands' => __('Northern Mariana Islands', true), 
	            'Norway' => __('Norway', true), 
	            'Oman' => __('Oman', true), 
	            'Pakistan' => __('Pakistan', true), 
	            'Palau' => __('Palau', true), 
	            'Panama' => __('Panama', true), 
	            'Papua New Guinea' => __('Papua New Guinea', true), 
	            'Paraguay' => __('Paraguay', true), 
	            'Peru' => __('Peru', true), 
	            'Philippines' => __('Philippines', true), 
	            'Pitcairn' => __('Pitcairn', true), 
	            'Poland' => __('Poland', true), 
	            'Portugal' => __('Portugal', true), 
	            'Puerto Rico' => __('Puerto Rico', true), 
	            'Qatar' => __('Qatar', true), 
	            'Reunion' => __('Reunion', true), 
	            'Romania' => __('Romania', true), 
	            'Russian Federation' => __('Russian Federation', true), 
	            'Rwanda' => __('Rwanda', true), 
	            'Saint Kitts and Nevis' => __('Saint Kitts and Nevis', true),  
	            'Saint LUCIA' => __('Saint LUCIA', true),  
	            'Saint Vincent and the Grenadines' => __('Saint Vincent and the Grenadines', true), 
	            'Samoa' => __('Samoa', true),  
	            'San Marino' => __('San Marino', true), 
	            'Sao Tome and Principe' => __('Sao Tome and Principe', true), 
	            'Saudi Arabia' => __('Saudi Arabia', true), 
	            'Senegal' => __('Senegal', true), 
	            'Seychelles' => __('Seychelles', true), 
	            'Sierra Leone' => __('Sierra Leone', true), 
	            'Singapore' => __('Singapore', true),  
	            'Slovakia' => __('Slovakia (Slovak Republic)', true), 
	            'Slovenia' => __('Slovenia', true), 
	            'Solomon Islands' => __('Solomon Islands', true), 
	            'Somalia' => __('Somalia', true),  
	            'South Africa' => __('South Africa', true), 
	            'South Georgia and the South Sandwich Islands' => __('South Georgia and the South Sandwich Islands', true), 
	            'Spain' => __('Spain', true), 
	            'Sri Lanka' => __('Sri Lanka', true), 
	            'St. Helena' => __('St. Helena', true), 
	            'St. Pierre and Miquelon' => __('St. Pierre and Miquelon', true),  
	            'Sudan' => __('Sudan', true),  
	            'Suriname' => __('Suriname', true), 
	            'Svalbard and Jan Mayen Islands' => __('Svalbard and Jan Mayen Islands', true), 
	            'Swaziland' => __('Swaziland', true),  
	            'Sweden' => __('Sweden', true), 
	            'Switzerland' => __('Switzerland', true),  
	            'Syrian Arab Republic' => __('Syrian Arab Republic', true), 
	            'Taiwan, Province of China' => __('Taiwan, Province of China', true), 
	            'Tajikistan' => __('Tajikistan', true), 
	            'Tanzania, United Republic of' => __('Tanzania, United Republic of', true), 
	            'Thailand' => __('Thailand', true), 
	            'Togo' => __('Togo', true), 
	            'Tokelau' => __('Tokelau', true), 
	            'Tonga' => __('Tonga', true),  
	            'Trinidad and Tobago' => __('Trinidad and Tobago', true),  
	            'Tunisia' => __('Tunisia', true),  
	            'Turkey' => __('Turkey', true), 
	            'Turkmenistan' => __('Turkmenistan', true), 
	            'Turks and Caicos Islands' => __('Turks and Caicos Islands', true), 
	            'Tuvalu' => __('Tuvalu', true), 
	            'Uganda' => __('Uganda', true), 
	            'Ukraine' => __('Ukraine', true), 
	            'United Arab Emirates' => __('United Arab Emirates', true), 
	            'United Kingdom' => __('United Kingdom', true), 
	            'United States' => __('United States', true), 
	            'United States Minor Outlying Islands' => __('United States Minor Outlying Islands', true), 
	            'Uruguay' => __('Uruguay', true),  
	            'Uzbekistan' => __('Uzbekistan', true), 
	            'Vanuatu' => __('Vanuatu', true),  
	            'Venezuela' => __('Venezuela', true), 
	            'Viet Nam' => __('Viet Nam', true), 
	            'Virgin Islands (British)' => __('Virgin Islands (British)', true), 
	            'Virgin Islands (U.S.)' => __('Virgin Islands (U.S.)', true),  
	            'Wallis and Futuna Islands' => __('Wallis and Futuna Islands', true),  
	            'Western Sahara' => __('Western Sahara', true), 
	            'Yemen' => __('Yemen', true),  
	            'Yugoslavia' => __('Yugoslavia', true), 
	            'Zambia' => __('Zambia', true), 
	            'Zimbabwe' => __('Zimbabwe', true)
	            )), array('label' => __('Country'), 'required' => true));
            ?>
		</div>
		<div class="large-6 columns">
		 	<?= $this->Form->input('sex', array('type' => 'radio', 'required' => true, 'options' => array(__('male'), __('female')), 'legend' => '', 'before' => '<label for = "UserSex">'.__('Sex').'</label>')) ?>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<?= $this->Form->input('description', array('label' => __('Description'), 'type' => 'textarea', 'required' => true)) ?>
		</div>
	</div>
	<?php 

		if($origin == 'dashboard'){
			echo $this->Form->hidden('organization_id', array('value' => $organization['Organization']['id']));
		}
		
		echo $this->Form->end('Add New User'); 
	?>

  <a class="close-reveal-modal">&#215;</a>
</div>