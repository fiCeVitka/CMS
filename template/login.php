<div class="ad_more">
    <!--Если пользователь не зашел-->
    <? if (!isset($_SESSION['login'])): ?>
    <img src="https://cdn2.iconfinder.com/data/icons/website-icons/512/User_Avatar-512.png">
    <form class="logout" method="post">
        <?
            if (isset($_SESSION['Error'])) echo $_SESSION['Error'];
            unset ($_SESSION['Error']);
        ?>
        <input type="text" name="login" placeholder="Логин">
        <input type="password" name="pass" placeholder="Пароль">
        <div class="buttons">
            <input type="submit" name="authorize" value="Авторизация">
            <input type="button" value="Регистрация" onClick='location.href="/register"'>
        </div>
    </form>
    <? else:?>
    Вы вошли как <? echo $_SESSION['login'];?>
    <form class="logout" method="post">
        <input type="submit" name="logout" value="Выход">
    </form>
    <? endif; ?>
</div>