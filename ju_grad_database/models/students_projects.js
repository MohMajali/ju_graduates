const { Sequelize, DataTypes } = require("sequelize");
const sequelize = require("../util/database");

const StudentProjects = sequelize.define(
  "student_projects",
  {
    id: {
      type: DataTypes.INTEGER,
      autoIncrement: true,
      allowNull: false,
      primaryKey: true,
    },
    student_id: {
      type: DataTypes.INTEGER,
      references: {
        model: "users",
        key: "id",
      },
    },
    title: {
      type: DataTypes.STRING,
      allowNull: false,
      required: true,
    },
    description: {
      type: DataTypes.TEXT,
      allowNull: false,
      required: true,
    },
    main_image: {
      type: DataTypes.TEXT,
      allowNull: false,
      required: true,
    },
    project_file: {
      type: DataTypes.TEXT,
      allowNull: false,
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

module.exports = StudentProjects;
