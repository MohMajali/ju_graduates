const { Sequelize, DataTypes } = require("sequelize");
const sequelize = require("../util/database");

const StudentsCourses = sequelize.define(
  "student_courses",
  {
    id: {
      type: DataTypes.INTEGER,
      autoIncrement: true,
      allowNull: false,
      primaryKey: true,
    },
    course_id: {
      type: DataTypes.INTEGER,
      references: {
        model: "courses",
        key: "id",
      },
    },
    student_id: {
      type: DataTypes.INTEGER,
      references: {
        model: "users",
        key: "id",
      },
    },
    start_date: {
      type: DataTypes.DATE,
      allowNull: false,
    },
    end_date: {
      type: DataTypes.DATE,
      allowNull: false,
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

module.exports = StudentsCourses;
