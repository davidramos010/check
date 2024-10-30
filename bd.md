-- check_ip.`User` definition

CREATE TABLE `User` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
`name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
`password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
`authKey` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
`accessToken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `User_UN` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- check_ip.perfiles definition

CREATE TABLE `perfiles` (
`id` int(11) NOT NULL,
`nombre` varchar(50) NOT NULL,
`descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- check_ip.perfiles_usuario definition

CREATE TABLE `perfiles_usuario` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`id_perfil` int(11) NOT NULL,
`id_user` int(11) NOT NULL,
PRIMARY KEY (`id`),
KEY `usuario_fk` (`id_user`),
KEY `perfil_fk` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;


-- check_ip.conexion definition

CREATE TABLE `conexion` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`nombre` varchar(250) NOT NULL,
`detalle` varchar(500) DEFAULT NULL,
`user_id` int(11) NOT NULL,
`tipo_id` int(11) NOT NULL,
`host` varchar(255) NOT NULL,
`user` varchar(255) DEFAULT NULL,
`password` varchar(255) DEFAULT NULL,
`db` varchar(255) DEFAULT NULL,
`attributes` varchar(255) DEFAULT NULL,
`estado` int(11) DEFAULT '1' COMMENT '1:activo, 0:inactivo',
`created_at` datetime DEFAULT CURRENT_TIMESTAMP,
`updated_at` datetime DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- check_ip.tipo definition

CREATE TABLE `tipo` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`nombre` varchar(100) NOT NULL,
`detalle` varchar(255) DEFAULT NULL,
`estado` int(11) DEFAULT '1' COMMENT '1:activo,0:inactivo',
`created_at` datetime DEFAULT CURRENT_TIMESTAMP,
`updated_at` datetime DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;


-- check_ip.log definition

CREATE TABLE `log` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`conexion_id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
`peticion` varchar(500) DEFAULT NULL,
`respuesta` varchar(500) DEFAULT NULL,
`codigo` int(11) NOT NULL,
`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- check_ip.User_info definition

CREATE TABLE `User_info` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`id_user` int(11) NOT NULL,
`nombres` varchar(255) NOT NULL,
`apellidos` varchar(255) NOT NULL,
`telefono` varchar(30) DEFAULT NULL,
`direccion` varchar(255) DEFAULT NULL,
`email` varchar(255) DEFAULT NULL,
`codigo` varchar(100) DEFAULT NULL,
`tipo_documento` int(11) DEFAULT NULL,
`documento` varchar(20) DEFAULT NULL,
`estado` int(11) DEFAULT '0' COMMENT '1: Activo: 0:Inactivo',
`created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `User_info_FK` (`id_user`),
CONSTRAINT `User_info_FK` FOREIGN KEY (`id_user`) REFERENCES `User` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO check_ip.`User` (id,username,name,password,authKey,accessToken) VALUES
(1,'DRAMOS','david ramos','6d3fca53a72b1b9e33a249fa6badee78','123456','123456');
INSERT INTO check_ip.User_info (id,id_user,nombres,apellidos,telefono,direccion,email,codigo,tipo_documento,documento,estado,created) VALUES
(1,1,'david','ramos','611135191',NULL,NULL,NULL,NULL,NULL,1,'2024-10-25 20:46:05');
INSERT INTO check_ip.perfiles (id,nombre,descripcion) VALUES
(1,'administrador','Admin'),
(2,'gestor','Ingreso y salida de llaves'),
(3,'gestor-general','Ingreso y salida de llaves con todos los permisos');
INSERT INTO check_ip.perfiles_usuario (id,id_perfil,id_user) VALUES
(37,1,1);
INSERT INTO check_ip.tipo (id,nombre,detalle,estado,created_at,updated_at) VALUES
(1,'host','validar una url especifica',1,'2024-10-30 19:48:16',NULL),
(2,'api','validar de disponibilidad de una api',1,'2024-10-30 19:51:42',NULL),
(3,'database','conectar a una bd',1,'2024-10-30 19:53:03',NULL);
