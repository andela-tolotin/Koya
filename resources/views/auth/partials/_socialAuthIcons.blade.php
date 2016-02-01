<div class="social-auth-icons">
    <ul>
       <li>
            {!!  html_entity_decode(link_to(url('facebook/authorize'), '<span class="fa fa-facebook fa-3x"></span>'))!!}
       </li>
        <li>
            {!!  html_entity_decode(link_to(url('github/authorize'), '<span class="fa fa-github fa-3x"></span>'))!!}
        </li>
        <li>
            {!!  html_entity_decode(link_to(url('twitter/authorize'), '<span class="fa fa-twitter fa-3x"></span>'))!!}
        </li>
    </ul>
</div>
