DROP DATABASE IF EXISTS web_prog_ex_sw17;
CREATE DATABASE IF NOT EXISTS web_prog_ex_sw17 CHARACTER SET utf8mb4;
USE web_prog_ex_sw17;

-- Dado que es un sistema medico, el genero no es suficiente
-- para que quien atienda a la persona le trate
-- pues las personas trans requieren cuidados con base
-- a su sexo en algunos casos, por lo tanto es necesario el sexo para tratar
-- pero el genero para referirse a la persona
CREATE TABLE persona(
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombres VARCHAR(50) NOT NULL,
  apellidos VARCHAR(50) NOT NULL,
  curp VARCHAR(20) NOT NULL,
  fecha_nac DATETIME NOT NULL,
  sexo ENUM('Masculino', 'Femenino') NOT NULL,
  genero ENUM('Hombre', 'Mujer', 'No-Binario', 'Agenero', 'Bigenero', 'Otro') DEFAULT 'Otro'
);

CREATE TABLE paciente(
  id INT PRIMARY KEY AUTO_INCREMENT,
  folio_expediente VARCHAR(30) NOT NULL,
  padecimiento_inicial VARCHAR(100) NOT NULL,
  persona_id INT NOT NULL,
  apoyo_externo ENUM('IMSS', 'ISSSTE', 'PEMEX', 'NINGUNO', 'OTRO') DEFAULT 'NINGUNO',
  fecha_ingreso DATETIME DEFAULT NOW(),
  FOREIGN KEY (persona_id) REFERENCES persona(id)
);

CREATE TABLE medico(
  id INT PRIMARY KEY AUTO_INCREMENT,
  persona_id INT NOT NULL,
  cedula_prof VARCHAR(30) NOT NULL,
  salario DECIMAL(12, 3) NOT NULL,
  fecha_ingreso DATETIME DEFAULT NOW(),
  FOREIGN KEY (persona_id) REFERENCES persona(id)
);

CREATE TABLE especialidad_medica(
  id INT PRIMARY KEY AUTO_INCREMENT,
  clave VARCHAR(20) NOT NULL,
  nombre VARCHAR(30) NOT NULL,
  descripcion VARCHAR(100) NOT NULL
);

-- Tabla auxiliar para referenciar las especialidades de los medicos
-- ya que en el esquema aparecen como tabla
-- entonces hacemos una entidad debil para ello

CREATE TABLE medico_especialista(
  medico_id INT NOT NULL,
  especialidad_id INT NOT NULL,
  FOREIGN KEY (medico_id) REFERENCES medico(id),
  FOREIGN KEY (especialidad_id) REFERENCES especialidad_medica(id),
  PRIMARY KEY (medico_id, especialidad_id)
);

-- anadiendo el campo de observaciones podemos crear un registro
-- mas completo para saber las razones de la cita y que sean mas rapidas

CREATE TABLE cita(
  id INT PRIMARY KEY AUTO_INCREMENT,
  hora_inicio DATETIME NOT NULL,
  hora_fin DATETIME NOT NULL,
  fecha_cita DATETIME NOT NULL,
  observaciones VARCHAR(60),
  paciente_id INT NOT NULL,
  medico_id INT NOT NULL,
  FOREIGN KEY (paciente_id) REFERENCES paciente(id),
  FOREIGN KEY (medico_id) REFERENCES medico(id)
);