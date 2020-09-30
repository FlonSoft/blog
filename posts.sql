CREATE TABLE `posts` (
  `id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` text NOT NULL,
  `title` text NOT NULL,
  `username` text NOT NULL,
  `content` text NOT NULL,
  `tags` text
);

ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;