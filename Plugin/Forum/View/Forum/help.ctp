<?php
$this->Breadcrumb->add(__d('forum', 'Help Desk'), array('controller' => 'forum', 'action' => 'help')); ?>

<div class="title">
    <h2><?php echo __d('forum', 'Help Desk'); ?></h2>
</div>

<div class="container">
    <p><b><?php echo __d('forum', 'Why do I need to sign up?'); ?></b><br>
    <?php echo __d('forum', 'You may read all public forums as a guest, but to be able to post or reply to a topic, you must have a user account.'); ?></p>

    <p><b><?php echo __d('forum', 'Why can\'t I post a topic, poll or reply?'); ?></b><br>
    <?php echo __d('forum', 'To begin you must have a user account and must be logged in. If you have done this, the topic might be locked or you do not have the proper access to post in that topic or forum.'); ?></p>

    <p><b><?php echo __d('forum', 'Why can\'t I login?'); ?></b><br>
    <?php echo __d('forum', 'The server might be having technical difficulties and your request could not be processed. It may also be that your account has been deleted or banned.'); ?></p>

    <p><b><?php echo __d('forum', 'Oh no, I forgot my password!'); ?></b><br>
    <?php printf(__d('forum', 'If you have forgotten your password, you can reset it using the %s form.'), $this->Html->link(__d('forum', 'forgotten password'), $userRoutes['forgotPass'])); ?></p>

    <p><b><?php echo __d('forum', 'What does reporting do?'); ?></b><br>
    <?php echo __d('forum', 'If you find a piece of content that you find inappropriate or offensive, you can report the content for a moderator to delete or fix.'); ?></p>

    <p><b><?php echo __d('forum', 'What are moderators, super moderators and administrators?'); ?></b><br>
    <?php echo __d('forum', 'Those are users with higher access and privileges than a regular user. Moderators control and moderate specific forums, where as Super Moderators have full access to all forums. Administrators have full access to all forums as well as editing all the sites settings and configuration. Additionally, moderates have the power to edit and delete other users content.'); ?></p>

    <p><b><?php echo __d('forum', 'How do I edit my profile?'); ?></b><br>
    <?php printf(__d('forum', 'Once you have logged in, you can edit your profile by going to the %s link, located at the top right.'), $this->Html->link(__d('forum', 'edit profile'), $userRoutes['settings'])); ?></p>

    <p><b><?php echo __d('forum', 'How do I post a topic?'); ?></b><br>
    <?php echo __d('forum', 'You would first navigate to the appropriate forum you want to post in. Once there, you would click the "Create Topic" link located at the top and bottom right of the page.'); ?></p>

    <p><b><?php echo __d('forum', 'How do I post a reply?'); ?></b><br>
    <?php echo __d('forum', 'When you are reading a topic and are logged in, you would click the "Post Reply" link also located at the top and bottom right of the page.'); ?></p>

    <p><b><?php echo __d('forum', 'How do I create a poll?'); ?></b><br>
    <?php echo __d('forum', 'You would create a poll the same way you would create a topic. First enter the correct forum, then hit the "Create Poll" link.'); ?></p>

    <p><b><?php echo __d('forum', 'How do I edit my topic, poll, post, etc?'); ?></b><br>
    <?php echo __d('forum', 'When you are reading a topic, at the top right of each post you will see a few text links. Hit the "Edit" link to edit your respective content. If you are editing the first post of a topic, it will additionally edit the topic or poll as well. You may only edit your own posts or topics unless you have moderating capabilities.'); ?></p>

    <p><b><?php echo __d('forum', 'How do I report a topic, post or user?'); ?></b><br>
    <?php echo __d('forum', 'At the top right of each post you would click the report button. From there you should add a comment on why you are reporting this content.'); ?></p>

    <p><b><?php echo __d('forum', 'How do I get higher access and permissions?'); ?></b><br>
    <?php echo __d('forum', 'It is up to the administrator to give you higher access. All you can do is be an outstanding member on the forum and hope they promote you.'); ?></p>

    <p><b><?php echo __d('forum', 'I have more questions that aren\'t shown here!'); ?></b><br>
    <?php printf(__d('forum', 'If you have additional questions and need further help, please contact us at %s.'), $settings['email']); ?></p>
</div>
