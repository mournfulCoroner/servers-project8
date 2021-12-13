package com.example.java.repository;

import com.example.java.modules.User;
import lombok.RequiredArgsConstructor;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
@RequiredArgsConstructor
public class UserRepository {
    private final JdbcTemplate jdbcTemplate;

    public User findByName(String name) {
        String SQL = "SELECT * FROM users WHERE name=? LIMIT 1";
        List<User> users = jdbcTemplate.query(SQL, new BeanPropertyRowMapper<>(User.class), name);
        return users.size() > 0 ? users.get(0) : null;
    }

    public List<User> selectAll() {
        String SQL = "SELECT * FROM users";
        return jdbcTemplate.query(SQL, new BeanPropertyRowMapper<>(User.class));
    }

    public boolean insert(User user) {
        String SQL = "INSERT INTO users (name, password) VALUES (?, ?)";
        return jdbcTemplate.update(SQL, user.getName(), user.getPassword()) > 0;
    }

    public boolean update(User user) {
        String SQL = "UPDATE users SET name=?, password=? WHERE ID=?";
        return jdbcTemplate.update(SQL, user.getName(), user.getPassword(), user.getId()) > 0;
    }

    public boolean delete(Integer id) {
        String SQL = "DELETE FROM `users` WHERE `ID`=?";
        return jdbcTemplate.update(SQL, id) > 0;
    }
}
