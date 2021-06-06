-- MySQL Workbench Forward Engineering


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`tipo_zona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`tipo_zona` (
  `id_tipo_zona` INT NOT NULL,
  `zona` VARCHAR(45) NULL,
  PRIMARY KEY (`id_tipo_zona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`plato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`plato` (
  `id_plato` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `imagen` TEXT NOT NULL,
  `descripcion` VARCHAR(150) NULL,
  `estado_id` TINYINT(1) NULL,
  PRIMARY KEY (`id_plato`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`tipo_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`tipo_categoria` (
  `id_tipo_categoria` INT NOT NULL,
  `plato_categria_tipo` VARCHAR(70) NULL,
  PRIMARY KEY (`id_tipo_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`plato_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`plato_categoria` (
  `id_plato_categoria` INT NOT NULL AUTO_INCREMENT,
  `tipo_categoria_id_tipo_categoria` INT NOT NULL,
  `plato_id_plato` INT NOT NULL,
  PRIMARY KEY (`id_plato_categoria`),
  INDEX `fk_plato_categoria_tipo_categoria1_idx` (`tipo_categoria_id_tipo_categoria` ASC) ,
  INDEX `fk_plato_categoria_plato1_idx` (`plato_id_plato` ASC) ,
  CONSTRAINT `fk_plato_categoria_tipo_categoria1`
    FOREIGN KEY (`tipo_categoria_id_tipo_categoria`)
    REFERENCES `bgiiiuvxua37prmuja21`.`tipo_categoria` (`id_tipo_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_plato_categoria_plato1`
    FOREIGN KEY (`plato_id_plato`)
    REFERENCES `bgiiiuvxua37prmuja21`.`plato` (`id_plato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`tipo_menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`tipo_menu` (
  `id_tipo_menu` INT NOT NULL,
  `tipo_menu` VARCHAR(75) NULL,
  PRIMARY KEY (`id_tipo_menu`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`almacen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`almacen` (
  `id_almacen` INT NOT NULL AUTO_INCREMENT,
  `almacen` VARCHAR(60) NULL,
  PRIMARY KEY (`id_almacen`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`lote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`lote` (
  `id_lote` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL,
  `cantidad_inicial` INT(10) NULL,
  `cantidad_disponible` INT(10) NULL,
  `tipo_menu_id_tipo_menu` INT NOT NULL,
  `plato_id_plato` INT NOT NULL,
  `almacen_id_almacen` INT NOT NULL,
  `tipo_zona_id_tipo_zona` INT NOT NULL,
  PRIMARY KEY (`id_lote`),
  INDEX `fk_lote_tipo_menu1_idx` (`tipo_menu_id_tipo_menu` ASC) ,
  INDEX `fk_lote_plato1_idx` (`plato_id_plato` ASC) ,
  INDEX `fk_lote_almacen1_idx` (`almacen_id_almacen` ASC) ,
  INDEX `fk_lote_tipo_zona1_idx` (`tipo_zona_id_tipo_zona` ASC) ,
  CONSTRAINT `fk_lote_tipo_menu1`
    FOREIGN KEY (`tipo_menu_id_tipo_menu`)
    REFERENCES `bgiiiuvxua37prmuja21`.`tipo_menu` (`id_tipo_menu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lote_plato1`
    FOREIGN KEY (`plato_id_plato`)
    REFERENCES `bgiiiuvxua37prmuja21`.`plato` (`id_plato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lote_almacen1`
    FOREIGN KEY (`almacen_id_almacen`)
    REFERENCES `bgiiiuvxua37prmuja21`.`almacen` (`id_almacen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lote_tipo_zona1`
    FOREIGN KEY (`tipo_zona_id_tipo_zona`)
    REFERENCES `bgiiiuvxua37prmuja21`.`tipo_zona` (`id_tipo_zona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`empleado` (
  `id_empleado` INT NOT NULL AUTO_INCREMENT,
  `emp_nombres` VARCHAR(45) NULL,
  `emp_apellidos` VARCHAR(45) NULL,
  `emp_usuario` VARCHAR(45) NULL,
  `emp_password` VARCHAR(45) NULL,
  `emp_email` VARCHAR(45) NULL,
  `emp_fecha_nacimiento` VARCHAR(45) NULL,
  `emp_dni` VARCHAR(45) NULL,
  `emp_direccion` VARCHAR(45) NULL,
  `emp_celular` VARCHAR(45) NULL,
  PRIMARY KEY (`id_empleado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `cli_nombres` VARCHAR(75) NULL,
  `cli_apellidos` VARCHAR(75) NULL,
  `cli_celular` CHAR(15) NULL,
  `cli_genero` CHAR(15) NULL,
  `cli_fecha_nacimiento` DATE NULL,
  `cli_user` VARCHAR(45) NULL,
  `cli_password` VARCHAR(250) NULL,
  `cli_email` VARCHAR(40) NULL,
  PRIMARY KEY (`id_cliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`cliente_direccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`cliente_direccion` (
  `id_cliente_direccion` INT NOT NULL AUTO_INCREMENT,
  `direccion` VARCHAR(150) NULL,
  `referencia` VARCHAR(50) NULL,
  `cliente_id_cliente` INT NOT NULL,
  `latitud` VARCHAR(50) NULL,
  `longitud` VARCHAR(50) NULL,
  PRIMARY KEY (`id_cliente_direccion`),
  INDEX `fk_cliente_direccion_cliente1_idx` (`cliente_id_cliente` ASC) ,
  CONSTRAINT `fk_cliente_direccion_cliente1`
    FOREIGN KEY (`cliente_id_cliente`)
    REFERENCES `bgiiiuvxua37prmuja21`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`pedido` (
  `id_pedido` INT NOT NULL AUTO_INCREMENT,
  `cliente_direccion_id_cliente_direccion` INT NOT NULL,
  `empleado_id_empleado` INT NOT NULL,
  `total_pedido` VARCHAR(45) NULL,
  `fecha` TIMESTAMP NULL,
  `latitud_iniciado` VARCHAR(100) NULL,
  `longitud_iniciado` VARCHAR(100) NULL,
  `latitud_entregado` VARCHAR(100) NULL,
  `longitud_entregado` VARCHAR(100) NULL,
  PRIMARY KEY (`id_pedido`),
  INDEX `fk_pedido_cliente_direccion1_idx` (`cliente_direccion_id_cliente_direccion` ASC) ,
  INDEX `fk_pedido_empleado1_idx` (`empleado_id_empleado` ASC) ,
  CONSTRAINT `fk_pedido_cliente_direccion1`
    FOREIGN KEY (`cliente_direccion_id_cliente_direccion`)
    REFERENCES `bgiiiuvxua37prmuja21`.`cliente_direccion` (`id_cliente_direccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_empleado1`
    FOREIGN KEY (`empleado_id_empleado`)
    REFERENCES `bgiiiuvxua37prmuja21`.`empleado` (`id_empleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`pedido_menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`pedido_menu` (
  `id_pedido_menu` INT NOT NULL,
  `cantidad_menu` INT(10) NULL,
  `pedido_id_pedido` INT NOT NULL,
  `subtotal` VARCHAR(45) NULL,
  PRIMARY KEY (`id_pedido_menu`),
  INDEX `fk_pedido_menu_pedido1_idx` (`pedido_id_pedido` ASC) ,
  CONSTRAINT `fk_pedido_menu_pedido1`
    FOREIGN KEY (`pedido_id_pedido`)
    REFERENCES `bgiiiuvxua37prmuja21`.`pedido` (`id_pedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`pedido_menu_detalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`pedido_menu_detalle` (
  `id_pedido_menu_detalle` INT NOT NULL,
  `plato_id_plato` INT NOT NULL,
  `cantidad` VARCHAR(45) NULL,
  `pedido_menu_detallecol` VARCHAR(45) NULL,
  `pedido_menu_id_pedido_menu` INT NOT NULL,
  PRIMARY KEY (`id_pedido_menu_detalle`),
  INDEX `fk_pedido_menu_detalle_plato1_idx` (`plato_id_plato` ASC) ,
  INDEX `fk_pedido_menu_detalle_pedido_menu1_idx` (`pedido_menu_id_pedido_menu` ASC) ,
  CONSTRAINT `fk_pedido_menu_detalle_plato1`
    FOREIGN KEY (`plato_id_plato`)
    REFERENCES `bgiiiuvxua37prmuja21`.`plato` (`id_plato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_menu_detalle_pedido_menu1`
    FOREIGN KEY (`pedido_menu_id_pedido_menu`)
    REFERENCES `bgiiiuvxua37prmuja21`.`pedido_menu` (`id_pedido_menu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bgiiiuvxua37prmuja21`.`repartidor_ubicacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bgiiiuvxua37prmuja21`.`repartidor_ubicacion` (
  `id_repartidor_ubicacion` INT NOT NULL,
  `ubicacion_hora` TIMESTAMP NULL,
  `ubicacion_latitud` VARCHAR(100) NULL,
  `ubicacion_longitud` VARCHAR(100) NULL,
  `empleado_id_empleado` INT NOT NULL,
  PRIMARY KEY (`id_repartidor_ubicacion`),
  INDEX `fk_repartidor_ubicacion_empleado1_idx` (`empleado_id_empleado` ASC) ,
  CONSTRAINT `fk_repartidor_ubicacion_empleado1`
    FOREIGN KEY (`empleado_id_empleado`)
    REFERENCES `bgiiiuvxua37prmuja21`.`empleado` (`id_empleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


