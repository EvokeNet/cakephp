<script id="evidence-type-image-template" type="text/x-handlebars-template">
<!-- IMAGE UPLOAD -->
    <?php
        //CSS
        echo $this->Html->css('FileUploader.file-uploader');

        $multiple = false;
        if (isset($allowMultiple)) {
            $multiple = $allowMultiple;
        }
    ?>

    <form action="https://silabe.s3.amazonaws.com/" method="POST" multiple="<?= $multiple ?>" enctype="multipart/form-data" data-identifier="<?php echo (isset($identifier) ? $identifier : ''); ?>">
        <?php
            // Upload deadline
            $datetime = null;

            if (isset($deadline)) {
                $datetime = new DateTime($deadline);
            } else {
                $datetime = new DateTime('+5 year');
            }

            $datetime->setTimezone(new DateTimeZone('UTC'));
            $expiration = $datetime->format('Y-m-d\TH:i:s\Z');

            // Fallback's redirection link
            $baseURL = '';

            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
                $baseURL = 'https';
            } else {
                $baseURL = 'http';
            }

            $baseURL .= '://'.$_SERVER['HTTP_HOST'];

            // File's path
            $key = 'evoke/uploads/';

            if (isset($keyPath)) {
                $key .= $keyPath;
            }

            // Upload policy
            $policyBucket = 'silabe';
            $policyPath = $key;

            if (isset($bucket)) {
                $policyBucket = $bucket;
            }

            if (isset($safePath)) {
                $policyPath = "evoke/uploads/{$safePath}";
            }

            $policy = '{"expiration": "'.$expiration.'", "conditions": ['
                      .'{"bucket": "'.$policyBucket.'"},'
                      .'["starts-with", "$key", "'.$policyPath.'"],'
                      .'["starts-with", "$Content-Type", ""]';

            $policyAjax = base64_encode($policy.']}');
            $policy = base64_encode(
                $policy.',["starts-with", "$redirect", "'
                .$baseURL.'"]]}'
            );

            // Form signature
            $signature = base64_encode(
                hash_hmac('sha1', $policy, Configure::read('AWS.S3.SecretKey'), true)
            );
            $signatureAjax = base64_encode(
                hash_hmac('sha1', $policyAjax, Configure::read('AWS.S3.SecretKey'), true)
            );
        ?>

        <input type="hidden" name="key" value="<?php echo $key; ?>${filename}" />
        <input type="hidden" name="AWSAccessKeyId" value="<?php echo Configure::read('AWS.S3.AccessKey'); ?>" />
        <input type="hidden" name="policy" value="<?php echo $policy; ?>" data-ajax="<?php echo $policyAjax; ?>" />
        <input type="hidden" name="signature" value="<?php echo $signature; ?>" data-ajax="<?php echo $signatureAjax; ?>" />
        <input type="hidden" name="redirect" value="<?php echo (isset($redirect) ? $redirect : ''); ?>" />
        <input type="hidden" name="Content-Type" value="application/octet-stream" />

        <div class="full-width text-center silabe-uploader" name="uploader">
            <div class="files" name="uploader-files"></div>
            <button type="button" class="tiny paddings-0 silabe-uploader-btn" id="evidence-img-button" data-file-input-id="fileinput-{{id}}">
                <div class="upload-button-text padding all-2">
                    <p class="margin top-2"><i class="fa fa-image fa-4x"></i></p>
                    <p><?php echo __("Upload your evidence's image"); ?></p>
                </div>

                <img id="file-content" />
            </button>

            <input type="file" id='fileinput-{{id}}' name='file' class='hide text-center' accept='image/jpeg,image/png' multiple="<?= $multiple ?>" /> 

            <input type="submit" class="button hidden btn-uploader-submit" value="<?php echo __('Send image'); ?>" />
        </div>

        <?php if (isset($alert)): ?>
            <p class="text-center"><small><?php echo $alert; ?></small></p>
        <?php endif; ?>
    </form>
</script>