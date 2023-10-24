const { Sequelize, DataTypes } = require("sequelize");
const sequelize = require("../util/database");

const UserTypes = sequelize.define(
  "user_types",
  {
    id: {
      type: DataTypes.INTEGER,
      autoIncrement: true,
      allowNull: false,
      primaryKey: true,
    },
    name: {
      type: DataTypes.STRING,
      required: true,
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

INSERT INTO `user_types` (`id`, `name`, `created_at`) 
VALUES (NULL, 'Admin', current_timestamp()), 
(NULL, 'Owner', current_timestamp()), 
(NULL, 'Client', current_timestamp());

*/

module.exports = UserTypes;
