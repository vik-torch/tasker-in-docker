START TRANSACTION;

CREATE TABLE `auth_users` (
  `id` int NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL
);


INSERT INTO `auth_users` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$0ea0OC2D/tqi6lOiZclioOo7hg3u9F6N.BRSegpRESoDpdY8aPhzy');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `text` text NOT NULL,
  `status` enum('NEW','DONE') CHARACTER SET utf8mb4 NOT NULL DEFAULT 'NEW',
  `user_id` int NOT NULL
  );

ALTER TABLE `tasks` ADD `is_edit` BOOLEAN NOT NULL DEFAULT FALSE AFTER `user_id`;


-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL
);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_users`
--
ALTER TABLE `auth_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_login` (`login`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auth_users`
--
ALTER TABLE `auth_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;
