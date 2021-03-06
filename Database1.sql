CREATE TABLE COMPANY
(
    COMPANY_NAME VARCHAR(30) PRIMARY KEY,
    ADMIN_USERNAME VARCHAR(30) NOT NULL,
    ADMIN_PASSWORD VARCHAR(60) NOT NULL,
    CONSTRAINT admin_username_unique
        UNIQUE (ADMIN_USERNAME),
    CONSTRAINT admin_password_unique
        UNIQUE (ADMIN_PASSWORD)
);

CREATE TABLE MOTOR
(
    MODEL VARCHAR(30) NOT NULL,
    NUM_PLATE INTEGER(15) PRIMARY KEY,
    CONSTRAINT motor_num_plate_unique
        UNIQUE (NUM_PLATE)
);

CREATE TABLE MEMBERSHIP
(
    MEMBERSHIP_ID INTEGER(15) AUTO_INCREMENT PRIMARY KEY,
    ANNUAL_FEE FLOAT(10) NOT NULL,
    EXPIRY_DATE DATE NOT NULL,
    NUM_OF_USE INTEGER(5) NOT NULL,
    CONSTRAINT membership_id_unique
        UNIQUE (MEMBERSHIP_ID)
);

CREATE TABLE CUSTOMER
(
    USER_ID INTEGER(15) AUTO_INCREMENT PRIMARY KEY,
    USERNAME VARCHAR(30) NOT NULL,
    PASSWORD VARCHAR(60) NOT NULL,
    CUS_NAME VARCHAR(30) NOT NULL,
    DOB DATE,
    PHONE INTEGER(10) NOT NULL,
    ADDRESS VARCHAR(50),
    MOTOR_NUM INTEGER(15),
    MEMBER_ID INTEGER(15),
    CONSTRAINT customer_username_unique
        UNIQUE (USERNAME),
    CONSTRAINT customer_id_unique
        UNIQUE (USER_ID),
    CONSTRAINT customer_member_id_unique
        UNIQUE (MEMBER_ID),
    CONSTRAINT customer_motor_fk
        FOREIGN KEY (MOTOR_NUM) REFERENCES MOTOR(NUM_PLATE),
    CONSTRAINT customer_membership_fk
        FOREIGN KEY (MEMBER_ID) REFERENCES MEMBERSHIP(MEMBERSHIP_ID)
);



CREATE TABLE PROFESSIONAL
(
    USER_ID INTEGER(15) AUTO_INCREMENT PRIMARY KEY,
    USERNAME VARCHAR(30) NOT NULL,
    PASSWORD VARCHAR(60) NOT NULL,
    PRO_NAME VARCHAR(30) NOT NULL,
    DOB DATE,
    PHONE INTEGER(10) NOT NULL,
    CONSTRAINT professional_id_unique
        UNIQUE (USER_ID),
    CONSTRAINT professional_username_unique
        UNIQUE (USERNAME)
);


CREATE TABLE SERVICE
(
    SERVICE_ID INTEGER(15) AUTO_INCREMENT PRIMARY KEY,
    SERVICE_NAME VARCHAR(30) NOT NULL,
	DESCRIPTION VARCHAR(200),
    PRICE INTEGER(5),
    PROFESSIONAL_ID INTEGER(15),
    CUSTOMER_ID INTEGER(15) NOT NULL,
    PROFESSIONAL_ACCEPTED BOOLEAN NOT NULL,
    IS_FINISHED BOOLEAN NOT NULL,
	LATITUDE FLOAT(10) NOT NULL,
	LONGITUDE FLOAT(10) NOT NULL,
    CONSTRAINT service_professional_fk_1
        FOREIGN KEY (PROFESSIONAL_ID) REFERENCES PROFESSIONAL(USER_ID),
    CONSTRAINT service_customer_fk
        FOREIGN KEY (CUSTOMER_ID) REFERENCES CUSTOMER(USER_ID)
);


CREATE TABLE REVIEW
(
    REVIEW_ID INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
    CUSTOMER_ID INTEGER(15) NOT NULL,
	PROFESSIONAL_ID INTEGER(15) NOT NULL,
    SERVICE_ID INTEGER(15) NOT NULL,
    RATING INTEGER(2) NOT NULL,
    COMMENCE VARCHAR(50),
    CONSTRAINT review_customer_fk
        FOREIGN KEY (CUSTOMER_ID) REFERENCES CUSTOMER(USER_ID),
    CONSTRAINT review_service_fk
        FOREIGN KEY (SERVICE_ID) REFERENCES SERVICE(SERVICE_ID),
	CONSTRAINT review_prof_fk
        FOREIGN KEY (PROFESSIONAL_ID) REFERENCES PROFESSIONAL(USER_ID)
);