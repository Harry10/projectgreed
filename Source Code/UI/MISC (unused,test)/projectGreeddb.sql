use greed;

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS stock;
DROP TABLE IF EXISTS portfolio;
DROP TABLE IF EXISTS account;
DROP TABLE IF EXISTS competition;
DROP TABLE IF EXISTS historical_stock;

CREATE TABLE stock
(stock_id INTEGER(8) NOT NULL,
stock_name VARCHAR(32) NOT NULL,
stock_value INTEGER(16),
quantity INTEGER(16),
portfolio_id INTEGER(8),
PRIMARY KEY(stock_id),
FOREIGN KEY(portfolio_id) REFERENCES portfolio(portfolio_id))ENGINE=InnoDB;

CREATE TABLE portfolio
(portfolio_id INTEGER(8) NOT NULL,
active BOOLEAN,
capital INTEGER(32),
account_id INTEGER(8) NOT NULL,
stock_id INTEGER(8),
competition_id INTEGER(8),
PRIMARY KEY(portfolio_id),
FOREIGN KEY(competition_id) REFERENCES competition(competition_id))
FOREIGN KEY(account_id) REFERENCES account(account_id))ENGINE=InnoDB;

CREATE TABLE account
(account_id INTEGER(8) NOT NULL,
username VARCHAR(32),
user_password VARCHAR(32),
portfolio_id INTEGER(8),
PRIMARY KEY(account_id))ENGINE=InnoD;

CREATE TABLE competition
(competition_id INTEGER(8) NOT NULL,
portfolio_id INTEGER(8),
account_id INTEGER(8),
PRIMARY KEY(competition_id),
FOREIGN KEY(account_id) REFERENCES account(account_id))ENGINE=InnoDB;

CREATE TABLE historical_stock
(hstock_id INTEGER(8) NOT NULL,
hstock_name VARCHAR(32) NOT NULL,
hstock_value INTEGER(16),
hquantity INTEGER(16),
date_taken DATE,
PRIMARY KEY(hstock_id INTEGER(8))ENGINE=InnoD;
