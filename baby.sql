-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 20 2024 г., 04:08
-- Версия сервера: 5.7.24
-- Версия PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `baby`
--

-- --------------------------------------------------------

--
-- Структура таблицы `back`
--

CREATE TABLE `back` (
  `id` int(11) NOT NULL,
  `email` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `breakfast`
--

CREATE TABLE `breakfast` (
  `id` int(11) NOT NULL,
  `name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `breakfast`
--

INSERT INTO `breakfast` (`id`, `name`) VALUES
(1, 'Каши: овсяная/рисовая/гречневая '),
(2, 'Бутерброд с маслом'),
(3, 'Чай');

-- --------------------------------------------------------

--
-- Структура таблицы `brunch`
--

CREATE TABLE `brunch` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `brunch`
--

INSERT INTO `brunch` (`id`, `name`) VALUES
(1, 'Первое блюдо: борщ/щи/лапша'),
(2, 'Второе блюдо: курица на пару/котлеты/рыба на пару'),
(3, 'Гарнир/салат'),
(4, 'Чай');

-- --------------------------------------------------------

--
-- Структура таблицы `child`
--

CREATE TABLE `child` (
  `id` int(11) NOT NULL,
  `first_name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_br` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `child`
--

INSERT INTO `child` (`id`, `first_name`, `middle_name`, `last_name`, `parent_id`, `group_id`, `date_br`) VALUES
(53, 'Сураева', 'Александра', 'Андреевна', '53', '8', '2020-02-01');

-- --------------------------------------------------------

--
-- Структура таблицы `data_menu`
--

CREATE TABLE `data_menu` (
  `id` int(11) NOT NULL,
  `to_date` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `be_date` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `data_menu`
--

INSERT INTO `data_menu` (`id`, `to_date`, `be_date`) VALUES
(1, '2024-05-01', '2024-05-07');

-- --------------------------------------------------------

--
-- Структура таблицы `dinner`
--

CREATE TABLE `dinner` (
  `id` int(11) NOT NULL,
  `name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dinner`
--

INSERT INTO `dinner` (`id`, `name`) VALUES
(1, 'Плов/овощное рагу/фрикадельки с подливой'),
(2, 'Блины/оладьи/булочки'),
(4, 'Чай/сок/компот');

-- --------------------------------------------------------

--
-- Структура таблицы `file`
--

CREATE TABLE `file` (
  `id` int(111) NOT NULL,
  `id_message` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `file`
--

INSERT INTO `file` (`id`, `id_message`, `file`) VALUES
(110, '195', 'uploads/664a50953a38b.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `data` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_group` int(111) NOT NULL,
  `workplan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mentor` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lesson`
--

INSERT INTO `lesson` (`id`, `data`, `id_group`, `workplan`, `id_mentor`) VALUES
(22, '2024-05-20', 8, '\"Путешествие по странам мира\": дети будут изучать культуру, традиции и обычаи разных стран, играя в различные игры, танцуя национальные танцы и пробуя национальные блюда. ', 54);

-- --------------------------------------------------------

--
-- Структура таблицы `lunch`
--

CREATE TABLE `lunch` (
  `id` int(11) NOT NULL,
  `name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lunch`
--

INSERT INTO `lunch` (`id`, `name`) VALUES
(1, 'Печенье/вафли/фрукты'),
(2, 'Чай/сок');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_group` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `id_group`, `id_user`, `text`, `time`, `data`, `admin`) VALUES
(194, '8', '53', 'Здравствуйте!\r\n', '19:16:20', '05.19.24', NULL),
(195, '8', '53', 'Прикрепляю домашнее задание!', '19:18:45', '05.19.24', NULL),
(196, '8', '54', 'Молодцы!', '19:19:55', '05.19.24', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `omission`
--

CREATE TABLE `omission` (
  `id` int(11) NOT NULL,
  `id_child` int(111) NOT NULL,
  `id_lesson` int(111) NOT NULL,
  `miss` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `score` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_first` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_last` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_first` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_last` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_back` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(111) NOT NULL,
  `id_group` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `omission`
--

INSERT INTO `omission` (`id`, `id_child`, `id_lesson`, `miss`, `comment`, `score`, `data_first`, `data_last`, `time_first`, `time_last`, `name_back`, `parent_id`, `id_group`) VALUES
(137, 53, 22, '+', 'Отлично справился с заданием.', '5', '2024-05-19', NULL, '18:11:22', NULL, '-', 53, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `submission`
--

CREATE TABLE `submission` (
  `id` int(11) NOT NULL,
  `id_parent` int(111) NOT NULL,
  `status` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_first` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_last_true` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_lats_false` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_first` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_last_true` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_lats_false` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_br` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `submission`
--

INSERT INTO `submission` (`id`, `id_parent`, `status`, `first_name`, `middle_name`, `last_name`, `data_first`, `data_last_true`, `data_lats_false`, `time_first`, `time_last_true`, `time_lats_false`, `date_br`) VALUES
(47, 53, 'approved', 'Сураева', 'Александра', 'Андреевна', '2024-05-19', '2024-05-19', NULL, '17:37:15', '17:41:14', NULL, '2020-02-01'),
(48, 53, 'approval', 'Сураев', 'Савелий', 'Андреевич', '2024-05-19', NULL, NULL, '17:38:06', NULL, NULL, '2021-05-05');

-- --------------------------------------------------------

--
-- Структура таблицы `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `team`
--

INSERT INTO `team` (`id`, `name`, `status`, `quantity`) VALUES
(8, 'Зайчики', 'free', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block` varchar(111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_mes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `password`, `group_id`, `role`, `block`, `new_mes`) VALUES
(52, 'Мельникова', 'Ангелина', 'Олеговна', 'admin@gmail.com', '+7(937)573-28-85', '6eadc4247eea2fd3ae622f5947471e74', '-', 'admin', '-', NULL),
(53, 'Сураева', 'Елизавета', 'Михайловна', 'elizaveta@gmail.com', '+7(937)573-28-80', 'da1f1beefe907dfcdd8400913d9b633f', '8', 'user', '-', NULL),
(54, 'Цурунова', 'Ксения', 'Павловна', 'ksenia@gmail.com', '+7(937)573-20-85', '2eecc5e344575606f7bf46011a5f45bd', '8', 'mentor', '-', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `back`
--
ALTER TABLE `back`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `breakfast`
--
ALTER TABLE `breakfast`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `brunch`
--
ALTER TABLE `brunch`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `data_menu`
--
ALTER TABLE `data_menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dinner`
--
ALTER TABLE `dinner`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lunch`
--
ALTER TABLE `lunch`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `omission`
--
ALTER TABLE `omission`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `back`
--
ALTER TABLE `back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `breakfast`
--
ALTER TABLE `breakfast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `brunch`
--
ALTER TABLE `brunch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `child`
--
ALTER TABLE `child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `data_menu`
--
ALTER TABLE `data_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dinner`
--
ALTER TABLE `dinner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `file`
--
ALTER TABLE `file`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT для таблицы `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `lunch`
--
ALTER TABLE `lunch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT для таблицы `omission`
--
ALTER TABLE `omission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT для таблицы `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
