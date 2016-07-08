jQuery(document).ready(function(){

    $('#FIO_FID1').attr('required', '').attr('placeholder', 'Ваше Имя...').after('<i class="ico_user"></i>');
    $('#PHONE_FID1').attr('required', '').attr('placeholder', 'Номер телефона...').after('<i class="ico_tel2"></i>');
    $('#EMAIL_FID1').attr('type', 'email').attr('required', '').attr('placeholder', 'Ваш E-mail...').after('<i class="ico_msg"></i>');
    $('#PASSWORD_FID1').attr('required', '').attr('placeholder', 'Введите Пароль...').after('<i class="ico_key"></i>');
    $('#EMPTY_TEXTFID1').attr('required', '').attr('placeholder', 'Ваше сообщение...').after('<i class="ico_plane"></i>');
});