const { Sequelize, DataTypes } = require("sequelize");
const sequelize = require("../util/database");

const StudentsMajors = sequelize.define(
  "student_majors",
  {
    id: {
      type: DataTypes.INTEGER,
      autoIncrement: true,
      allowNull: false,
      primaryKey: true,
    },
    major_id: {
      type: DataTypes.INTEGER,
      references: {
        model: "majors",
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
    gpa: {
      type: DataTypes.DOUBLE,
      allowNull: false,
      required: true,
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

module.exports = StudentsMajors;
