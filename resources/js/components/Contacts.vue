<template lang="pug">
.container
    .row
        // Section Titile
        .col-md-12.wow.animated.fadeInLeft(data-wow-delay='.2s')
            h1.section-title Love to Hear From You
    .row
        // Section Titile
        .col-md-6.mt-3.contact-widget-section2.wow.animated.fadeInLeft(data-wow-delay='.2s')
            p
                | It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content.
            .find-widget
                | Company:  
                a(href='https://hostriver.ro') HostRiver
            .find-widget
                | Address: 
                a(href='#') 4435 Berkshire Circle Knoxville
            .find-widget
                | Phone:  
                a(href='#') + 879-890-9767
            .find-widget
                | Website:  
                a(href='https://uny.ro') www.uny.ro
            .find-widget
                | Program: 
                a(href='#') Mon to Sat: 09:30 AM - 10.30 PM
        // contact form
        .col-md-6.wow.animated.fadeInRight(data-wow-delay='.2s')
            form#contactForm.shake(role='form' method='post' name='contact-form' data-toggle='validator')
                // Name
                .form-group.label-floating
                    label.control-label(for='name') Name
                    input#name.form-control(type='text' name='name' required='' data-error='Please enter your name')
                    .help-block.with-errors
                // email
                .form-group.label-floating
                    label.control-label(for='email') Email
                    input#email.form-control(type='email' name='email' required='' data-error='Please enter your Email')
                    .help-block.with-errors
                // Subject
                .form-group.label-floating
                    label.control-label Subject
                    input#msg_subject.form-control(type='text' name='subject' required='' data-error='Please enter your message subject')
                    .help-block.with-errors
                // Message
                .form-group.label-floating
                    label.control-label(for='message') Message
                    textarea#message.form-control(rows='3' name='message' required='' data-error='Write your message')
                    .help-block.with-errors
                // Form Submit
                .form-submit.mt-5
                    button#form-submit.btn.btn-common(type='submit')
                        i.material-icons.mdi.mdi-message-outline
                        |  Send Message
                    #msgSubmit.h3.text-center.hidden
                    .clearfix
</template>