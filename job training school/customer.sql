#�f�[�^�x�[�X�̈�̑I��
USE lesson;
#�e�[�u���̍폜
DROP TABLE IF EXISTS customer;
#�e�[�u���̍쐬
CREATE TABLE customer (
id INT AUTO_INCREMENT PRIMARY KEY,
name CHAR(20) NOT NULL,
address TEXT NOT NULL
);
#���R�[�h�̒ǉ�
INSERT INTO customer (name, address) VALUES ('��؈�Y', '�����s');
INSERT INTO customer (name, address) VALUES ('Shaquille O\'Neal', '�Ȗ،�');
INSERT INTO customer (name, address) VALUES ('�c����ܘY', '�k�C��');
INSERT INTO customer (name, address) VALUES ('�����m��', '��t��');
INSERT INTO customer (name, address) VALUES ('�ؑ����Y', '���ꌧ');
INSERT INTO customer (name, address) VALUES ('���X�ؔ���', '�a�̎R��');

#���R�[�h�̕ύX
UPDATE customer SET name='�ؑ���ܘY' WHERE id=3;
UPDATE customer SET address='���{' WHERE id=5;
UPDATE customer SET name='�C�`���[', address='�V�A�g��' WHERE id=1;

#���R�[�h�̍폜
DELETE FROM customer WHERE id=4;