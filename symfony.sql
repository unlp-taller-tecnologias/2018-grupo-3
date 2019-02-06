INSERT INTO `etiqueta` (`id`, `nombre`) VALUES
(4, 'Avisos'),
(3, 'Exámenes'),
(1, 'Notas'),
(5, 'Otros');


INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'administrador'),
(2, 'moderador'),
(3, 'responsable');


INSERT INTO `usuario` (`id`, `rol_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `nombre`, `apellido`, `visado`, `telefono_contacto`, `catedra_id`) VALUES
(16, 1, 'admin', 'admin', 'carteleravirtual2018@gmail.com', 'carteleravirtual2018@gmail.com', 1, NULL, '$2y$13$CnfAUDP85ri1TusScSf4RuM2TjHWV2mn8cw7.f/VR3IxwFcYm4tbq', '2019-02-05 18:35:26', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'admin', 'admin', 0, NULL, NULL);

