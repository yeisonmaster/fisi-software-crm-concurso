-- DATA DE PRUEBA EXTERNA (CAMPANA, INTERLOCUTOR_COMERCIA, PRODUCTO, OPERACION)

INSERT INTO `campana` (`id`, `nombre`, `estado`, `codigo_mes` ) VALUES
(1, 'Emprendemos Junio', 1, 201606);

INSERT INTO `interlocutor_comercial` (`id`, `zona_id`, `roles_id`, `codigo`, `nombre`, `apellido`, `email`, `telefono`, `estado`) VALUES
(1, 1, 1, 'P0001', 'Jhon', 'Snow', 'nombre@mail.com', '12345678', 1),
(2, 1, 1, 'P0002', 'Arya', 'Stark', 'nombre@persona.net', '1234567', 1),
(3, 1, 1, 'P0003', 'Ed', 'Stark', 'nombre2@persona.com', '135454354', 1);
(4, 1, 1, 'P0004', 'Tyrion', 'Lannister', 'nombre2@persona.com', '135454354', 1);

INSERT INTO `producto` (`id`, `familia_id`, `codigo`, `nombre`, `unidad`, `precio`, `precio_vta`, `descuento`, `estado`) VALUES
(1, 1, 'PROD0001', 'PERFUME HUGO BOSS', 50, 60.00, 60.00, 0, 1),
(2, 1, 'PROD0002', 'PERFUME YAMBAL', 20, 80.00, 80.00, 0, 1),
(3, 1, 'PROD0003', 'PERFUME ESIKA', 60, 50.00,  50.00, 0, 1),
(4, 2, 'PROD0004', 'KIT DE ASEO PERSONAL', 15, 30.00, 30.00, 0, 1),
(5, 2, 'PROD0005', 'KIT DE ASEO PERSONAL DAMA', 25, 30.00, 30.00, 0, 1),
(6, 3, 'PROD0006', 'CARTERA DE DAMA', 30, 90.00, 90.00, 0, 1),
(7, 4, 'PROD0007', 'DESODORANTE PERSONAL', 10, 20.00, 20.00, 0, 1);

INSERT INTO `pedido` (`id`, `tipo_pedido_id`, `interlocutor_comercial_id`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 2),
(5, 1, 2),
(6, 1, 3),
(7, 1, 3),
(8, 1, 3),
(9, 1, 4);
(10, 1, 1),
(11, 1, 1),
(12, 1, 1),
(13, 1, 1),
(14, 1, 2),
(15, 1, 2),
(16, 1, 3),
(17, 1, 3),
(18, 1, 3),
(19, 1, 4);
(20, 1, 4);

INSERT INTO `operacion` (`id`, `tipo_operacion_id`, `pedido_id`, `codigo_operacion`, `monto_operacion`, `estado`, `observacion`, `fecha_operacion`) VALUES
(1, 1, 1, 'OPE0001', 100.00, 1, 'Enviado', '2016-06-01 00:00:00'),
(2, 1, 2, 'OPE0002', 50.00, 1, 'Enviado', '2016-06-02 00:00:00'),
(3, 2, 3, 'OPE0003', 35.00, 1, 'Enviado', '2016-06-03 00:00:00'),
(4, 2, 4, 'OPE0004', 55.00, 1, 'No Enviado', '2016-06-11 00:00:00');
(5, 1, 1, 'OPE0005', 100.00, 1, 'Enviado', '2016-06-01 00:00:00'),
(6, 1, 2, 'OPE0006', 50.00, 1, 'Enviado', '2016-06-02 00:00:00'),
(7, 2, 3, 'OPE0007', 35.00, 1, 'Enviado', '2016-06-03 00:00:00'),
(8, 2, 4, 'OPE0008', 55.00, 1, 'No Enviado', '2016-06-11 00:00:00');
(9, 1, 1, 'OPE0009', 100.00, 1, 'Enviado', '2016-06-01 00:00:00'),
(10, 1, 2, 'OPE0010', 50.00, 1, 'Enviado', '2016-06-02 00:00:00'),
(11, 2, 3, 'OPE0011', 35.00, 1, 'Enviado', '2016-06-03 00:00:00'),
(12, 2, 4, 'OPE0012', 55.00, 1, 'No Enviado', '2016-06-11 00:00:00');
(13, 1, 1, 'OPE0013', 100.00, 1, 'Enviado', '2016-06-01 00:00:00'),
(14, 1, 2, 'OPE0014', 50.00, 1, 'Enviado', '2016-06-02 00:00:00'),
(15, 2, 3, 'OPE0015', 35.00, 1, 'Enviado', '2016-06-03 00:00:00'),
(16, 2, 4, 'OPE0016', 55.00, 1, 'No Enviado', '2016-06-11 00:00:00');
(17, 2, 4, 'OPE0017', 55.00, 1, 'No Enviado', '2016-06-11 00:00:00');
(18, 2, 4, 'OPE0018', 55.00, 1, 'No Enviado', '2016-06-11 00:00:00');
(19, 2, 4, 'OPE0019', 55.00, 1, 'No Enviado', '2016-06-11 00:00:00');
(20, 2, 4, 'OPE0020', 55.00, 1, 'No Enviado', '2016-06-11 00:00:00');