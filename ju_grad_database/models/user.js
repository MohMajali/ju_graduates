const { Sequelize, DataTypes } = require("sequelize");
const sequelize = require("../util/database");

const User = sequelize.define(
  "users",
  {
    id: {
      type: DataTypes.INTEGER,
      autoIncrement: true,
      allowNull: false,
      primaryKey: true,
    },
    user_type_id: {
      type: DataTypes.INTEGER,
      references: {
        model: "user_types",
        key: "id",
      },
    },
    name: {
      type: DataTypes.STRING,
      allowNull: false,
      required: true,
    },
    email: {
      type: DataTypes.STRING,
      allowNull: false,
      required: true,
    },
    password: {
      type: DataTypes.STRING,
      allowNull: false,
      required: true,
    },
    phone: {
      type: DataTypes.STRING,
      allowNull: false,
      required: true,
    },
    image: {
      type: DataTypes.STRING,
      allowNull: true,
      defaultValue: "Student-Images/userDefault.png",
    },
    active: {
      type: DataTypes.INTEGER,
      allowNull: false,
      defaultValue: 1,
    },
    created_at: {
      type: DataTypes.DATE,
      allowNull: false,
      defaultValue: Sequelize.literal("CURRENT_TIMESTAMP"),
    },
  },
  {
    timestamps: false,
  }
);

/*

INSERT INTO `users` (`id`, `user_type_id`, `name`, `email`, `password`, `phone`, `image`, `active`, `created_at`) 
VALUES (NULL, '1', 'Admin', 'admin@monasabati.com', '123456', '0123456789', 'Admin_Dashboard/defalutUser.png', '1', current_timestamp()), 
(NULL, '2', 'Owner', 'owner@monasabati.com', '123456', '9876543210', 'Owner_Dashboard/defalutUser.png', '1', current_timestamp()), 
(NULL, '3', 'Client', 'client@monasabati.com', '123456', '0147852369', 'Client_Dashboard/defalutUser.png', '1', current_timestamp());

*/

module.exports = User;
