package com.example.java.repository;

import com.example.java.modules.FileInfo;
import com.example.java.modules.InterestingFact;
import com.example.java.modules.UserInfo;
import lombok.RequiredArgsConstructor;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.support.GeneratedKeyHolder;
import org.springframework.jdbc.support.KeyHolder;
import org.springframework.stereotype.Repository;

import java.math.BigInteger;
import java.sql.PreparedStatement;
import java.sql.Statement;
import java.util.List;
import java.util.Map;

@Repository
@RequiredArgsConstructor
public class FileRepository {
    private final JdbcTemplate jdbcTemplate;

    public List<FileInfo> selectAll() {
        String SQL = "SELECT * FROM files_info";
        return jdbcTemplate.query(SQL, new BeanPropertyRowMapper<>(FileInfo.class));
    }

    public Integer insert(FileInfo fileInfo) {
        String SQL = "INSERT INTO files_info (name) VALUES (?)";
        KeyHolder key = new GeneratedKeyHolder();

        jdbcTemplate.update(
                connection -> {
                    PreparedStatement ps = connection.prepareStatement(SQL, Statement.RETURN_GENERATED_KEYS);
                    ps.setString(1, fileInfo.getName());
                    return ps;
                },
                key);

        return ((BigInteger) key.getKeyList().get(0).get("GENERATED_KEY")).intValue();
    }
}
