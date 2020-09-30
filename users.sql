CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(200) NOT NULL,
  `emailHash` text NOT NULL,
  `password` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bio` text,
  `type` varchar(150) NOT NULL DEFAULT 'normal',
  `pfp` text
);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
