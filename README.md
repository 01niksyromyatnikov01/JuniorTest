# JuniorTest
# Старт
Установить в настройках приложения своё соединение с базой.
Провести миграции.
Посев данных (присутствуют стартовые данные для базы по таблицам "пользователи","статьи","комментарии").
Также возможно переключать локализацию(Английский язык/Русский язык) в шапке страниц.
<h3>Данные для входа</h3>
Email: <b>123456789@gmail.com</b> Password: <b>admin</b><br>
Email: <b>987654321@gmail.com</b> Password: <b>admin</b><br><br>
После создания статьи она приватна, изменить статус можно в пункте модерирования в своем профиле. Приватная статья видна только автору!<br>

# Пример
<a href = "https://niksyromyatnikov.000webhostapp.com/">Демо</a> <br>
<b>Однако, следует отметить, что на данном хостинге запрещены
методы PUT и DELETE, так что некоторый функционал(изменение статуса статьи/отписка/удаление статьи) недоступен.</b>

# API
API: все запросы, кроме GET, должны содержать как минимум токен(находится в профиле у пользователя)
все апи-методы находятся в файле  routes/api.php
URL запросов c описанием: 
<ul>
<li><b>GET</b>:  news.test/api/comments/{id} ,(id - идентификатор статьи) вывод комментариев для конкретной статьи</li>
<li><b>POST</b>: news.test/api/comments - создание комментария, также передаем параметры(token,article_id,text)</li> 
<li><b>GET</b>:  news.test/api/articles - вывод всех активных новостей</li>
<li><b>GET</b>:  news.test/api/articles/{id} - вывод статьи по идентификатору</li>
<li><b>GET</b>:  news.test/api/article/ - вывод последней статьи</li>
<li><b>POST</b>: news.test/api/articles - создание статьи, параметры(token,header,description)</li>
<li><b>DELETE</b>: news.test/api/article/{article} - удаление статьи, параметры(token)</li>
<li><b>PUT</b>: news.test/api/article/{id} - изменение статуса статьи (публичная - 1, приватная - 0) параметры(token,active(0/1))</li>
<li><b>GET</b>: news.test/api/users/subscribers/{id} - вывод кол-ва подписчиков для пользователя номер id</li>
<li><b>POST</b>: news.test/users/subscribers/list/{id} - вывод списка подписчиков для пользователя с идентификатором id</li>
<li><b>POST</b>: news.test/api/users/subscribe - подписаться на пользователя, параметры(user_id - на кого подписываемся,token)</li>
<li><b>POST</b>: news.test/api/users/unsubscribe - отписаться от пользователя, параметры(user_id - от кого отписываемся,token)</li>
</ul>

