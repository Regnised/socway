#language: ru

Функционал: Турнирная таблица

Сценарий: Открыть страницу турнирной таблицы и проверить наличие двух команд
Если я на странице "/api/standings"
#И выведи последний ответ сервера
И тело ответа должно содержать "Arsenal"
И тело ответа должно содержать "Everton"