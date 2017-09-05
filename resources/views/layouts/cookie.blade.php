<div class="cookie d-flex">
    <p>
        <i class="fa fa-info-circle"></i>
        Diese Seite verwendet Cookies um Ihre Sicherheit zu gewährleisten.
    </p>
    <button id="accept" type="button" class="btn ml-auto"><i class="fa fa-check"></i></button>
    {{Cookie::get('ev_allow_cookies')}}
</div>

<script type="text/javascript">
console.log(document.cookie.indexOf("ev_allow_cookies="))
var btn = document.getElementById('accept')

if (document.cookie.indexOf("ev_allow_cookies") >= 0) {
    btn.parentElement.remove()
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

btn.addEventListener('click', function(){
    btn.parentElement.remove()
    setCookie('ev_allow_cookies', 'true', 366)
    console.log("clicked")
});
</script>
